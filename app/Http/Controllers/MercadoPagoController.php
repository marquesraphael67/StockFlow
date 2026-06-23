<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoController extends Controller
{
    public function gerarPix(Request $request)
    {
        $request->validate([
            'plano' => 'required|in:basico,pro,premium',
        ]);

        $valores = [
            'basico' => 39.00,
            'pro' => 79.00,
            'premium' => 149.00,
        ];

        $plano = $request->plano;
        $valor = $valores[$plano];

        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));

        $client = new PaymentClient();

        try {
            $payment = $client->create([
                'transaction_amount' => (float) $valor,
                'description' => 'Assinatura StockFlow - Plano ' . ucfirst($plano),
                'payment_method_id' => 'pix',
                'payer' => [
                    'email' => 'comprador_stockflow@test.com',
                    'first_name' => auth()->user()->name,
                ],
            ]);
        } catch (MPApiException $e) {
            return redirect()
                ->route('checkout', ['plano' => $plano])
                ->with('erro', 'O Mercado Pago está instável no momento. Tente gerar o PIX novamente em alguns minutos.');
        }

        $pagamento = Pagamento::create([
            'empresa_id' => auth()->user()->empresa_id,
            'plano' => $plano,
            'valor' => $valor,
            'mercado_pago_id' => $payment->id,
            'status' => $payment->status,
            'qr_code' => $payment->point_of_interaction->transaction_data->qr_code ?? null,
            'qr_code_base64' => $payment->point_of_interaction->transaction_data->qr_code_base64 ?? null,
        ]);

        return redirect()->route('checkout.pix', $pagamento->id);
    }

    public function pix($id)
    {
        $pagamento = Pagamento::where('empresa_id', auth()->user()->empresa_id)
            ->findOrFail($id);

        return view('checkout-pix', compact('pagamento'));
    }

    public function webhook(Request $request)
    {
        Log::info('WEBHOOK MERCADO PAGO RECEBIDO', $request->all());

        $paymentId = $request->input('data.id') ?? $request->input('id');

        if (!$paymentId) {
            return response()->json([
                'message' => 'Webhook recebido sem ID de pagamento.'
            ], 200);
        }

        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));

        $client = new PaymentClient();

        try {
            $payment = $client->get($paymentId);
        } catch (MPApiException $e) {
            Log::error('ERRO AO CONSULTAR PAGAMENTO MERCADO PAGO', [
                'payment_id' => $paymentId,
                'status' => $e->getApiResponse()->getStatusCode(),
                'content' => $e->getApiResponse()->getContent(),
            ]);

            return response()->json([
                'message' => 'Erro ao consultar pagamento.'
            ], 200);
        }

        $pagamento = Pagamento::where('mercado_pago_id', $payment->id)->first();

        if (!$pagamento) {
            Log::warning('PAGAMENTO NÃO ENCONTRADO NO STOCKFLOW', [
                'mercado_pago_id' => $payment->id,
                'status' => $payment->status,
            ]);

            return response()->json([
                'message' => 'Pagamento não encontrado.'
            ], 200);
        }

        $pagamento->update([
            'status' => $payment->status,
        ]);

        $pagamento->refresh();
        $pagamento->ativarAssinatura();

        return response()->json([
            'message' => 'Webhook processado com sucesso.'
        ], 200);
    }
}