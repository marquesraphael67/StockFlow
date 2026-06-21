<div>
    <div class="mb-4">
        <h1 class="fw-bold mb-0">Planos e Pagamentos</h1>
        <small class="text-muted">Gerencie assinatura, plano atual e histórico de pagamentos.</small>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">{{ $empresa->nome }}</h4>
                <p class="text-muted mb-0">
                    Plano atual:
                    <strong>{{ ucfirst($empresa->plano) }}</strong>
                    • Status:
                    <strong>{{ ucfirst($empresa->status) }}</strong>
                </p>

                @if($empresa->status === 'trial')
                    <span class="badge bg-warning text-dark mt-2">
                        Teste grátis: {{ $diasTrial }} dias restantes
                    </span>
                @else
                    <span class="badge bg-success mt-2">
                        Assinatura ativa
                    </span>
                @endif
            </div>

            <a href="{{ route('checkout') }}?plano={{ $empresa->plano }}" class="btn btn-primary">
                <i class="bi bi-credit-card me-2"></i>
                Renovar / pagar plano
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        @php
            $planos = [
                'basico' => [
                    'nome' => 'Básico',
                    'valor' => 39,
                    'descricao' => 'Ideal para começar.',
                    'recursos' => [
                        '1 usuário',
                        'Até 500 produtos',
                        'Controle de estoque',
                        'Vendas e clientes',
                    ],
                ],
                'pro' => [
                    'nome' => 'Pro',
                    'valor' => 79,
                    'descricao' => 'Mais escolhido para pequenos comércios.',
                    'recursos' => [
                        'Até 5 usuários',
                        'Produtos ilimitados',
                        'Dashboard avançado',
                        'Relatórios completos',
                    ],
                ],
                'premium' => [
                    'nome' => 'Premium',
                    'valor' => 149,
                    'descricao' => 'Para empresas que precisam de mais controle.',
                    'recursos' => [
                        'Usuários ilimitados',
                        'Relatórios PDF',
                        'Dashboard premium',
                        'Suporte prioritário',
                    ],
                ],
            ];
        @endphp

        @foreach($planos as $key => $plano)
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 {{ $empresa->plano === $key ? 'border border-primary' : '' }}">
                    <div class="card-body p-4">
                        @if($empresa->plano === $key)
                            <span class="badge bg-primary mb-3">Plano atual</span>
                        @elseif($key === 'pro')
                            <span class="badge bg-success mb-3">Mais escolhido</span>
                        @endif

                        <h4 class="fw-bold">{{ $plano['nome'] }}</h4>
                        <p class="text-muted">{{ $plano['descricao'] }}</p>

                        <h2 class="fw-bold text-primary">
                            R$ {{ number_format($plano['valor'], 2, ',', '.') }}
                            <small class="fs-6 text-muted">/mês</small>
                        </h2>

                        <hr>

                        @foreach($plano['recursos'] as $recurso)
                            <p class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                {{ $recurso }}
                            </p>
                        @endforeach

                        @if($empresa->plano === $key)
                            <button class="btn btn-outline-primary w-100 mt-3" disabled>
                                Plano atual
                            </button>
                        @else
                            <a href="{{ route('checkout') }}?plano={{ $key }}" class="btn btn-primary w-100 mt-3">
                                Escolher plano
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-receipt me-2 text-primary"></i>
                Histórico de pagamentos
            </h5>
        </div>

        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Plano</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>ID Mercado Pago</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pagamentos as $pagamento)
                        <tr>
                            <td>{{ $pagamento->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ ucfirst($pagamento->plano) }}</td>
                            <td>R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                            <td>
                                @if($pagamento->status === 'approved')
                                    <span class="badge bg-success">Aprovado</span>
                                @elseif($pagamento->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pendente</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($pagamento->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $pagamento->mercado_pago_id ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Nenhum pagamento registrado ainda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>