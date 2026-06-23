<div>
    <div class="mb-4">
        <h1 class="fw-bold mb-0">Central de Assinaturas</h1>
        <small class="text-muted">Gerencie seu plano, pagamentos e status da conta.</small>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <span class="badge bg-primary mb-3">Plano atual</span>

                            <h2 class="fw-bold mb-1">
                                {{ ucfirst($empresa->plano) }}
                            </h2>

                            <p class="text-muted mb-3">
                                Empresa: <strong>{{ $empresa->nome }}</strong>
                            </p>

                            @if($empresa->status === 'trial')
                                <div class="alert alert-warning border-0 mb-0">
                                    <i class="bi bi-clock me-2"></i>
                                    Você está no teste grátis. Restam
                                    <strong>{{ $diasTrial }} dias</strong>.
                                </div>
                            @elseif($empresa->status === 'ativo')
                                <div class="alert alert-success border-0 mb-0">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Sua assinatura está ativa.
                                </div>
                            @else
                                <div class="alert alert-danger border-0 mb-0">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    Sua assinatura precisa de atenção.
                                </div>
                            @endif
                        </div>

                        <div class="text-end">
                            <p class="text-muted mb-1">Status</p>

                            @if($empresa->status === 'trial')
                                <span class="badge bg-warning text-dark fs-6">Trial</span>
                            @elseif($empresa->status === 'ativo')
                                <span class="badge bg-success fs-6">Ativo</span>
                            @else
                                <span class="badge bg-danger fs-6">{{ ucfirst($empresa->status) }}</span>
                            @endif

                            <div class="mt-3">
                                <a href="{{ route('checkout') }}?plano={{ $empresa->plano }}" class="btn btn-primary">
                                    <i class="bi bi-credit-card me-2"></i>
                                    Renovar plano
                                </a>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 rounded-4 bg-light">
                                <small class="text-muted">Plano</small>
                                <h5 class="fw-bold mb-0">{{ ucfirst($empresa->plano) }}</h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 rounded-4 bg-light">
                                <small class="text-muted">Dias restantes</small>
                                <h5 class="fw-bold mb-0">
                                    {{ $empresa->status === 'trial' ? $diasTrial : 'Ativo' }}
                                </h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 rounded-4 bg-light">
                                <small class="text-muted">Último pagamento</small>
                                <h5 class="fw-bold mb-0">
                                    @if($ultimoPagamento)
                                        R$ {{ number_format($ultimoPagamento->valor, 2, ',', '.') }}
                                    @else
                                        Nenhum
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-receipt me-2 text-primary"></i>
                        Última cobrança
                    </h5>

                    @if($ultimoPagamento)
                        <p class="mb-1">
                            Plano: <strong>{{ ucfirst($ultimoPagamento->plano) }}</strong>
                        </p>

                        <p class="mb-1">
                            Valor: <strong>R$ {{ number_format($ultimoPagamento->valor, 2, ',', '.') }}</strong>
                        </p>

                        <p class="mb-1">
                            Data: <strong>{{ $ultimoPagamento->created_at->format('d/m/Y H:i') }}</strong>
                        </p>

                        <p class="mb-3">
                            Status:
                            @if($ultimoPagamento->status === 'approved')
                                <span class="badge bg-success">Aprovado</span>
                            @elseif($ultimoPagamento->status === 'pending')
                                <span class="badge bg-warning text-dark">Pendente</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($ultimoPagamento->status) }}</span>
                            @endif
                        </p>

                        @if($ultimoPagamento->status === 'pending')
                            <a href="{{ route('checkout.pix', $ultimoPagamento->id) }}" class="btn btn-outline-primary w-100">
                                Ver PIX pendente
                            </a>
                        @endif
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-receipt fs-1"></i>
                            <p class="mt-2 mb-0">Nenhuma cobrança registrada.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        @php
            $planos = [
                'basico' => [
                    'nome' => 'Básico',
                    'valor' => 39,
                    'descricao' => 'Ideal para iniciar o controle da empresa.',
                    'recursos' => [
                        '1 usuário',
                        'Até 500 produtos',
                        'Clientes e vendas',
                        'Controle de estoque',
                    ],
                ],
                'pro' => [
                    'nome' => 'Pro',
                    'valor' => 79,
                    'descricao' => 'O plano mais indicado para pequenos comércios.',
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
                    'descricao' => 'Para empresas que precisam de controle completo.',
                    'recursos' => [
                        'Usuários ilimitados',
                        'Dashboard premium',
                        'Relatórios PDF',
                        'Suporte prioritário',
                    ],
                ],
            ];
        @endphp

        @foreach($planos as $key => $plano)
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 {{ $empresa->plano === $key ? 'border border-primary border-2' : '' }}">
                    <div class="card-body p-4">
                        @if($empresa->plano === $key)
                            <span class="badge bg-primary mb-3">Plano atual</span>
                        @elseif($key === 'pro')
                            <span class="badge bg-success mb-3">Mais escolhido</span>
                        @else
                            <span class="badge bg-light text-dark mb-3">Disponível</span>
                        @endif

                        <h4 class="fw-bold">{{ $plano['nome'] }}</h4>
                        <p class="text-muted">{{ $plano['descricao'] }}</p>

                        <h2 class="fw-bold text-primary">
                            R$ {{ number_format($plano['valor'], 2, ',', '.') }}
                            <small class="text-muted fs-6">/mês</small>
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
                                Escolher {{ $plano['nome'] }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-clock-history me-2 text-primary"></i>
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
                        <th>Ação</th>
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
                            <td>
                                @if($pagamento->status === 'pending')
                                    <a href="{{ route('checkout.pix', $pagamento->id) }}" class="btn btn-sm btn-outline-primary">
                                        Ver PIX
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Nenhum pagamento registrado ainda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>