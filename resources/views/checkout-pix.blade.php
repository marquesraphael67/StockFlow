<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5 text-center">
                    <h1 class="fw-bold mb-2">Pagamento via PIX</h1>
                    <p class="text-muted">
                        Escaneie o QR Code ou copie o código PIX abaixo.
                    </p>

                    <div class="my-4">
                        @if($pagamento->qr_code_base64)
                            <img src="data:image/png;base64,{{ $pagamento->qr_code_base64 }}"
                                 style="max-width: 280px;"
                                 class="img-fluid rounded border p-2 bg-white">
                        @endif
                    </div>

                    <h4 class="fw-bold">
                        R$ {{ number_format($pagamento->valor, 2, ',', '.') }}
                    </h4>

                    <p class="text-muted">
                        Plano {{ ucfirst($pagamento->plano) }}
                    </p>

                    <label class="form-label fw-bold mt-3">PIX copia e cola</label>
                    <textarea class="form-control" rows="5" readonly>{{ $pagamento->qr_code }}</textarea>

                    <div class="alert alert-info mt-4">
                        Após o pagamento, o Mercado Pago enviará uma confirmação para ativar seu plano.
                    </div>

                    <a href="{{ route('assinatura.index') }}" class="btn btn-outline-primary">
                        Voltar para assinatura
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>