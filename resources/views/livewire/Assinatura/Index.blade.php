<div>
    <div class="premium-hero mb-4">
        <div>
            <span class="premium-badge">
                <i class="bi bi-stars"></i> Central de Assinaturas
            </span>

            <h1 class="fw-bold mt-3 mb-2">Plano e assinatura</h1>

            <p class="text-muted mb-0">
                Gerencie seu plano, status, pagamentos e upgrades do StockFlow.
            </p>
        </div>

        <div class="hero-action">
            <a href="{{ route('checkout') }}?plano={{ $empresa->plano }}" class="btn btn-light fw-semibold">
                <i class="bi bi-credit-card me-2"></i>
                Renovar plano
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="premium-card h-100">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-4">
                    <div>
                        <span class="status-pill status-{{ $empresa->status }}">
                            {{ ucfirst($empresa->status) }}
                        </span>

                        <h2 class="fw-bold mt-3 mb-1">
                            Plano {{ ucfirst($empresa->plano) }}
                        </h2>

                        <p class="text-muted mb-3">
                            Empresa: <strong>{{ $empresa->nome }}</strong>
                        </p>

                        @if($empresa->status === 'trial')
                            <div class="trial-box">
                                <i class="bi bi-hourglass-split"></i>
                                <div>
                                    <strong>Teste grátis ativo</strong>
                                    <p class="mb-0">Restam {{ $diasTrial }} dias para o fim do trial.</p>
                                </div>
                            </div>
                        @elseif($empresa->status === 'ativo')
                            <div class="success-box">
                                <i class="bi bi-check-circle"></i>
                                <div>
                                    <strong>Assinatura ativa</strong>
                                    <p class="mb-0">Seu acesso premium está liberado.</p>
                                </div>
                            </div>
                        @else
                            <div class="danger-box">
                                <i class="bi bi-exclamation-triangle"></i>
                                <div>
                                    <strong>Assinatura pendente</strong>
                                    <p class="mb-0">Escolha um plano para continuar usando o sistema.</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="text-lg-end">
                        <small class="text-muted d-block">Próxima cobrança</small>

                        <h5 class="fw-bold mb-3">
                            {{ $assinatura->data_expiracao ? $assinatura->data_expiracao->format('d/m/Y') : 'Não definida' }}
                        </h5>

                        <a href="{{ route('checkout') }}?plano={{ $empresa->plano }}" class="btn btn-primary rounded-pill px-4">
                            Gerenciar pagamento
                        </a>
                    </div>
                </div>

                <div class="row g-3 mt-4">
                    <div class="col-md-4">
                        <div class="mini-kpi">
                            <span>Plano atual</span>
                            <strong>{{ ucfirst($empresa->plano) }}</strong>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mini-kpi">
                            <span>Status</span>
                            <strong>{{ ucfirst($empresa->status) }}</strong>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mini-kpi">
                            <span>Último pagamento</span>
                            <strong>
                                @if($ultimoPagamento)
                                    R$ {{ number_format($ultimoPagamento->valor, 2, ',', '.') }}
                                @else
                                    Nenhum
                                @endif
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="premium-card h-100">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="icon-box">
                        <i class="bi bi-receipt"></i>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-0">Última cobrança</h5>
                        <small class="text-muted">Pagamento mais recente</small>
                    </div>
                </div>

                @if($ultimoPagamento)
                    <div class="payment-line">
                        <span>Plano</span>
                        <strong>{{ ucfirst($ultimoPagamento->plano) }}</strong>
                    </div>

                    <div class="payment-line">
                        <span>Valor</span>
                        <strong>R$ {{ number_format($ultimoPagamento->valor, 2, ',', '.') }}</strong>
                    </div>

                    <div class="payment-line">
                        <span>Status</span>
                        <strong>{{ ucfirst($ultimoPagamento->status) }}</strong>
                    </div>

                    <div class="payment-line">
                        <span>Data</span>
                        <strong>{{ $ultimoPagamento->created_at->format('d/m/Y H:i') }}</strong>
                    </div>

                    @if($ultimoPagamento->status === 'pending')
                        <a href="{{ route('checkout.pix', $ultimoPagamento->id) }}" class="btn btn-outline-primary w-100 rounded-pill mt-3">
                            Ver PIX pendente
                        </a>
                    @endif
                @else
                    <div class="empty-state">
                        <i class="bi bi-credit-card-2-front"></i>
                        <p>Nenhuma cobrança registrada.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        @foreach($planos as $key => $plano)
            <div class="col-lg-4">
                <div class="plan-card {{ $empresa->plano === $key ? 'active-plan' : '' }}">
                    @if($empresa->plano === $key)
                        <span class="premium-badge">Plano atual</span>
                    @elseif($key === 'pro')
                        <span class="popular-badge">Mais escolhido</span>
                    @else
                        <span class="available-badge">Disponível</span>
                    @endif

                    <h4 class="fw-bold mt-3">{{ $plano['nome'] }}</h4>

                    <p class="text-muted">{{ $plano['descricao'] }}</p>

                    <div class="price">
                        R$ {{ number_format($plano['valor'], 2, ',', '.') }}
                        <small>/mês</small>
                    </div>

                    <hr>

                    @foreach($plano['recursos'] as $recurso)
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>{{ $recurso }}</span>
                        </div>
                    @endforeach

                    @if($empresa->plano === $key)
                        <button class="btn btn-outline-primary w-100 rounded-pill mt-4" disabled>
                            Plano atual
                        </button>
                    @else
                        <a href="{{ route('checkout') }}?plano={{ $key }}" class="btn btn-primary w-100 rounded-pill mt-4">
                            Fazer upgrade
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="premium-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-0">Histórico de pagamentos</h5>
                <small class="text-muted">Todos os pagamentos gerados no Mercado Pago</small>
            </div>

            <i class="bi bi-clock-history fs-3 text-primary"></i>
        </div>

        <div class="table-responsive">
            <table class="table align-middle premium-table">
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
                                <span class="table-status">
                                    {{ ucfirst($pagamento->status) }}
                                </span>
                            </td>
                            <td>{{ $pagamento->mercado_pago_id ?? '-' }}</td>
                            <td>
                                @if($pagamento->status === 'pending')
                                    <a href="{{ route('checkout.pix', $pagamento->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                        Ver PIX
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                Nenhum pagamento registrado ainda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .premium-hero {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            border-radius: 28px;
            padding: 32px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
            box-shadow: 0 24px 60px rgba(13, 110, 253, .25);
        }

        .premium-hero .text-muted {
            color: rgba(255,255,255,.75) !important;
        }

        .premium-badge,
        .popular-badge,
        .available-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 700;
        }

        .premium-badge {
            background: rgba(255,255,255,.18);
            color: white;
            backdrop-filter: blur(12px);
        }

        .popular-badge {
            background: #dcfce7;
            color: #166534;
        }

        .available-badge {
            background: #f1f5f9;
            color: #334155;
        }

        .premium-card,
        .plan-card {
            background: rgba(255,255,255,.86);
            border: 1px solid rgba(226,232,240,.9);
            border-radius: 26px;
            padding: 28px;
            box-shadow: 0 18px 45px rgba(15,23,42,.08);
            backdrop-filter: blur(16px);
            transition: .25s ease;
        }

        .premium-card:hover,
        .plan-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 60px rgba(15,23,42,.12);
        }

        .active-plan {
            border: 2px solid #0d6efd;
        }

        .status-pill {
            padding: 8px 14px;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 800;
        }

        .status-trial {
            background: #fff7ed;
            color: #c2410c;
        }

        .status-ativo {
            background: #dcfce7;
            color: #166534;
        }

        .status-inativo,
        .status-cancelado,
        .status-bloqueado {
            background: #fee2e2;
            color: #991b1b;
        }

        .trial-box,
        .success-box,
        .danger-box {
            display: flex;
            gap: 14px;
            padding: 16px;
            border-radius: 20px;
        }

        .trial-box {
            background: #fff7ed;
            color: #9a3412;
        }

        .success-box {
            background: #ecfdf5;
            color: #166534;
        }

        .danger-box {
            background: #fef2f2;
            color: #991b1b;
        }

        .mini-kpi {
            background: #f8fafc;
            padding: 18px;
            border-radius: 20px;
        }

        .mini-kpi span,
        .payment-line span {
            display: block;
            color: #64748b;
            font-size: .85rem;
        }

        .mini-kpi strong {
            font-size: 1.1rem;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            background: #eff6ff;
            color: #0d6efd;
            font-size: 1.4rem;
        }

        .payment-line {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 13px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .price {
            font-size: 2.1rem;
            font-weight: 800;
            color: #0d6efd;
        }

        .price small {
            font-size: .95rem;
            color: #64748b;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            color: #334155;
        }

        .feature-item i {
            color: #16a34a;
        }

        .premium-table thead th {
            color: #64748b;
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .04em;
            border-bottom: 1px solid #e2e8f0;
        }

        .premium-table tbody td {
            padding: 16px 8px;
        }

        .table-status {
            background: #f1f5f9;
            color: #334155;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 700;
        }

        .empty-state {
            text-align: center;
            color: #64748b;
            padding: 32px 0;
        }

        .empty-state i {
            font-size: 2.5rem;
        }

        @media (max-width: 768px) {
            .premium-hero {
                flex-direction: column;
                align-items: flex-start;
                padding: 24px;
            }

            .hero-action,
            .hero-action a {
                width: 100%;
            }

            .premium-card,
            .plan-card {
                padding: 22px;
            }
        }

        body.dark-mode .premium-card,
        body.dark-mode .plan-card {
            background: rgba(15, 23, 42, .86);
            border-color: rgba(51, 65, 85, .9);
            color: #e5e7eb;
        }

        body.dark-mode .mini-kpi,
        body.dark-mode .available-badge,
        body.dark-mode .table-status {
            background: rgba(30, 41, 59, .9);
            color: #e5e7eb;
        }

        body.dark-mode .premium-table {
            color: #e5e7eb;
        }
    </style>
</div>