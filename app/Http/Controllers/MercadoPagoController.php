<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;
use MercadoPago\Client\Payment\PaymentClient;
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

        $payment = $client->create([
            "transaction_amount" => $valor,
            "description" => "Assinatura StockFlow - Plano " . ucfirst($plano),
            "payment_method_id" => "pix",
            "payer" => [
                "email" => auth()->user()->email,
                "first_name" => auth()->user()->name,
            ],
        ]);

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
}