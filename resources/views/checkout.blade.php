<x-app-layout>
    <div class="container py-5">
        <h1 class="fw-bold mb-3">Finalizar assinatura</h1>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <p class="text-muted">
                    Plano escolhido:
                    <strong>{{ ucfirst(request('plano', 'basico')) }}</strong>
                </p>

                <div class="alert alert-info">
                    Em breve aqui entraremos com Mercado Pago, PIX, cartão e assinatura recorrente.
                </div>

                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                    Continuar para o painel
                </a>
            </div>
        </div>
    </div>
</x-app-layout>