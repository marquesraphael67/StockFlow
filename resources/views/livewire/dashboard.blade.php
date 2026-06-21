<div>
    <style>
        .premium-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
            transition: .2s;
            background: #ffffff;
        }

        .premium-card:hover {
            transform: translateY(-2px);
        }

        .icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        .bg-soft-primary { background: #e8f1ff; color: #2563eb; }
        .bg-soft-success { background: #e9f8ef; color: #198754; }
        .bg-soft-warning { background: #fff4df; color: #f59f00; }
        .bg-soft-danger { background: #ffecec; color: #dc3545; }
        .bg-soft-info { background: #e8f8ff; color: #0dcaf0; }
        .bg-soft-dark { background: #eef2f7; color: #0f172a; }

        .welcome-card {
            border-radius: 22px;
            background: #ffffff;
            border: 0;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        }

        .trial-badge {
            background: #e8f1ff;
            color: #2563eb;
            border-radius: 999px;
            padding: 8px 14px;
            font-weight: 700;
            font-size: 13px;
        }

        .table thead th {
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
        }

        .table td {
            vertical-align: middle;
        }
    </style>

    @php
        $trialEnds = auth()->user()->empresa->trial_ends_at;
        $diasTrial = $trialEnds ? max(0, ceil(now()->diffInHours($trialEnds, false) / 24)) : 0;
    @endphp

    @if(session('erro'))
        <div class="alert alert-warning border-0 shadow-sm mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('erro') }}
        </div>
    @endif

    <div class="welcome-card mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="fw-bold mb-1">
                        Olá, {{ auth()->user()->name }} 
                    </h1>
                    <p class="text-muted mb-0">
                        Acompanhe vendas, lucro, estoque e desempenho da sua empresa.
                    </p>
                </div>

                <div class="text-end">
                    <a href="{{ route('relatorios.pdf') }}" class="btn btn-primary fw-bold mb-2">
                        <i class="bi bi-file-earmark-pdf me-1"></i>
                        Exportar PDF
                    </a>

                    <div>
                        <span class="trial-badge">
                            Plano {{ ucfirst(auth()->user()->empresa->plano) }}

                            @if(auth()->user()->empresa->status === 'trial')
                                • Teste gratuito de   {{ $diasTrial }} dias
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card premium-card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Faturamento Total</p>
                        <h3 class="fw-bold mb-0">R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</h3>
                    </div>
                    <div class="icon-box bg-soft-primary">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card premium-card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Lucro Total</p>
                        <h3 class="fw-bold text-success mb-0">R$ {{ number_format($lucroTotal, 2, ',', '.') }}</h3>
                    </div>
                    <div class="icon-box bg-soft-success">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card premium-card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Ticket Médio</p>
                        <h3 class="fw-bold mb-0">R$ {{ number_format($ticketMedio, 2, ',', '.') }}</h3>
                    </div>
                    <div class="icon-box bg-soft-info">
                        <i class="bi bi-receipt"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card premium-card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Vendas Hoje</p>
                        <h3 class="fw-bold mb-0">{{ $vendasHoje }}</h3>
                    </div>
                    <div class="icon-box bg-soft-warning">
                        <i class="bi bi-cart-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card premium-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-soft-dark">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Produtos Ativos</p>
                        <h4 class="fw-bold mb-0">{{ $totalProdutos }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card premium-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-soft-success">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Clientes Ativos</p>
                        <h4 class="fw-bold mb-0">{{ $totalClientes }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card premium-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-soft-primary">
                        <i class="bi bi-bag-check"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Total de Vendas</p>
                        <h4 class="fw-bold mb-0">{{ $totalVendas }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card premium-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-soft-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Estoque Baixo</p>
                        <h4 class="fw-bold mb-0">{{ $estoqueBaixo }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card premium-card h-100">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-bar-chart me-2 text-primary"></i>
                        Vendas dos últimos 7 dias
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="graficoVendas" height="140"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card premium-card h-100">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-activity me-2 text-success"></i>
                        Faturamento dos últimos 7 dias
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="graficoFaturamento" height="140"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card premium-card h-100">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-trophy me-2 text-warning"></i>
                        Top 5 produtos vendidos
                    </h5>
                </div>

                <div class="card-body">
                    @forelse($topProdutos as $item)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <div>
                                <strong>{{ $item->produto->nome ?? 'Produto removido' }}</strong>
                                <div class="text-muted small">Quantidade vendida</div>
                            </div>
                            <span class="badge bg-primary rounded-pill fs-6">
                                {{ $item->total_vendido }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-box fs-1"></i>
                            <p class="mt-2 mb-0">Nenhum produto vendido ainda.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card premium-card h-100">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-stars me-2 text-success"></i>
                        Top 5 clientes
                    </h5>
                </div>

                <div class="card-body">
                    @forelse($topClientes as $cliente)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <div>
                                <strong>{{ $cliente->cliente->nome ?? 'Cliente removido' }}</strong>
                                <div class="text-muted small">
                                    {{ $cliente->total_compras }} compra(s)
                                </div>
                            </div>
                            <span class="fw-bold text-success">
                                R$ {{ number_format($cliente->total_gasto, 2, ',', '.') }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-people fs-1"></i>
                            <p class="mt-2 mb-0">Nenhum cliente ranqueado ainda.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="card premium-card">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-clock-history me-2 text-primary"></i>
                Últimas vendas
            </h5>

            <a href="{{ route('vendas.index') }}" class="btn btn-outline-primary btn-sm">
                Ver vendas
            </a>
        </div>

        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Lucro</th>
                        <th>Data</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($ultimasVendas as $venda)
                        <tr>
                            <td>
                                <strong>{{ $venda->cliente->nome ?? 'Consumidor final' }}</strong>
                            </td>
                            <td>R$ {{ number_format($venda->total, 2, ',', '.') }}</td>
                            <td class="text-success fw-bold">
                                R$ {{ number_format($venda->lucro_total, 2, ',', '.') }}
                            </td>
                            <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Nenhuma venda registrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const vendas7Dias = @json($vendas7Dias);
        const faturamento7Dias = @json($faturamento7Dias);

        new Chart(document.getElementById('graficoVendas'), {
            type: 'bar',
            data: {
                labels: vendas7Dias.map(item => item.dia),
                datasets: [{
                    label: 'Vendas',
                    data: vendas7Dias.map(item => item.total),
                    borderRadius: 8
                }]
            },
            options: {
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('graficoFaturamento'), {
            type: 'line',
            data: {
                labels: faturamento7Dias.map(item => item.dia),
                datasets: [{
                    label: 'Faturamento R$',
                    data: faturamento7Dias.map(item => item.total),
                    tension: .4,
                    fill: true
                }]
            },
            options: {
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>