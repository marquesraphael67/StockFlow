<div>
    <h1 class="fw-bold mb-1">Plano e Assinatura</h1>
    <p class="text-muted">Gerencie seu plano do StockFlow.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="alert alert-primary">
        Plano atual: <strong>{{ ucfirst($empresa->plano) }}</strong><br>
        Status: <strong>{{ ucfirst($empresa->status) }}</strong><br>
        Teste grátis expira em:
        <strong>{{ now()->diffInDays($empresa->trial_ends_at, false) }} dias</strong>
    </div>

    <div class="row g-4">
        @foreach([
            'basico' => ['Básico', 'R$ 39/mês', '1 usuário, até 500 produtos'],
            'pro' => ['Pro', 'R$ 79/mês', 'Até 5 usuários, produtos ilimitados'],
            'premium' => ['Premium', 'R$ 149/mês', 'Usuários ilimitados, relatórios PDF']
        ] as $key => $plano)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <h4 class="fw-bold">{{ $plano[0] }}</h4>
                        <h2 class="text-primary">{{ $plano[1] }}</h2>
                        <p class="text-muted">{{ $plano[2] }}</p>

                        @if($empresa->plano === $key)
                            <button class="btn btn-success w-100" disabled>Plano atual</button>
                        @else
                            <button wire:click="alterarPlano('{{ $key }}')" class="btn btn-outline-primary w-100">
                                Alterar para {{ $plano[0] }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body">
            <h5 class="fw-bold">Pagamento</h5>
            <p class="text-muted mb-0">
                Em breve: integração com Mercado Pago, PIX, cartão e assinatura recorrente.
            </p>
        </div>
    </div>
</div>