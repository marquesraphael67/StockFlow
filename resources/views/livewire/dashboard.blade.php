<div>
    <style>
        .motion-div{animation:fadeUp .45s ease both}
        @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}

        .premium-hero{
            background:linear-gradient(135deg,#0f172a,#2563eb);
            color:white;
            border-radius:30px;
            padding:32px;
            box-shadow:0 24px 60px rgba(37,99,235,.28);
        }

        .premium-badge{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:8px 14px;
            border-radius:999px;
            background:rgba(255,255,255,.16);
            color:white;
            font-size:.82rem;
            font-weight:700;
            backdrop-filter:blur(14px);
        }

        .premium-card,.kpi-card{
            background:rgba(255,255,255,.88);
            border:1px solid rgba(226,232,240,.9);
            border-radius:28px;
            box-shadow:0 18px 45px rgba(15,23,42,.08);
            backdrop-filter:blur(18px);
            transition:.25s ease;
        }

        .premium-card:hover,.kpi-card:hover{
            transform:translateY(-3px);
            box-shadow:0 24px 60px rgba(15,23,42,.12);
        }

        .kpi-card{
            padding:22px;
            height:100%;
        }

        .icon-soft{
            width:50px;
            height:50px;
            border-radius:18px;
            display:grid;
            place-items:center;
            background:#eff6ff;
            color:#2563eb;
            font-size:1.5rem;
        }

        .quick-action{
            background:rgba(255,255,255,.88);
            border:1px solid rgba(226,232,240,.9);
            border-radius:22px;
            padding:18px;
            text-decoration:none;
            color:#0f172a;
            display:flex;
            align-items:center;
            gap:14px;
            box-shadow:0 12px 35px rgba(15,23,42,.06);
            transition:.25s ease;
        }

        .quick-action:hover{
            transform:translateY(-3px);
            color:#2563eb;
        }

        .premium-table thead th{
            color:#64748b;
            font-size:.78rem;
            text-transform:uppercase;
            letter-spacing:.05em;
            border-bottom:1px solid #e2e8f0;
        }

        .premium-table tbody td{
            padding:18px 10px;
            vertical-align:middle;
        }

        .premium-table tbody tr:hover{
            background:rgba(37,99,235,.045);
        }

        .rank-item{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:14px;
            padding:16px 0;
            border-bottom:1px solid #e2e8f0;
        }

        .rank-number{
            width:36px;
            height:36px;
            border-radius:14px;
            display:grid;
            place-items:center;
            background:#eff6ff;
            color:#2563eb;
            font-weight:800;
        }

        .empty-state{
            text-align:center;
            color:#64748b;
            padding:40px 0;
        }

        .empty-state i{
            font-size:2.5rem;
            display:block;
            margin-bottom:10px;
        }

        @media(max-width:768px){
            .premium-hero{padding:24px}
            .premium-card,.kpi-card{border-radius:22px}
        }

        body.dark-mode .premium-card,
        body.dark-mode .kpi-card,
        body.dark-mode .quick-action{
            background:rgba(15,23,42,.88);
            border-color:rgba(51,65,85,.9);
            color:#e5e7eb;
        }

        body.dark-mode .premium-table{
            color:#e5e7eb;
        }
    </style>

    @php
        $empresa = auth()->user()->empresa;
        $trialEnds = $empresa->trial_ends_at;
        $diasTrial = $trialEnds ? max(0, ceil(now()->diffInHours($trialEnds, false) / 24)) : 0;
    @endphp

    @if(session('erro'))
        <div class="alert alert-warning border-0 shadow-sm rounded-4 mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('erro') }}
        </div>
    @endif

    <div class="premium-hero mb-4 motion-div">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
            <div>
                <span class="premium-badge">
                    <i class="bi bi-stars"></i>
                    Dashboard Executivo
                </span>

                <h1 class="fw-bold mt-3 mb-2">
                    Olá, {{ auth()->user()->name }}
                </h1>

                <p class="mb-0 opacity-75">
                    Acompanhe vendas, lucro, estoque, clientes e desempenho da sua empresa.
                </p>
            </div>

            <div class="text-lg-end">
                <a href="{{ route('relatorios.pdf') }}" class="btn btn-light rounded-pill px-4 fw-semibold mb-2">
                    <i class="bi bi-file-earmark-pdf me-2"></i>
                    Exportar PDF
                </a>

                <div>
                    <span class="premium-badge">
                        Plano {{ ucfirst($empresa->plano) }}

                        @if($empresa->status === 'trial')
                            • Trial: {{ $diasTrial }} dias
                        @else
                            • {{ ucfirst($empresa->status) }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>

    @if($empresa->status === 'trial' && $diasTrial <= 3)
        <div class="alert alert-warning border-0 shadow-sm rounded-4 motion-div">
            <i class="bi bi-hourglass-split me-2"></i>
            Seu teste grátis termina em <strong>{{ $diasTrial }} dias</strong>.
            <a href="{{ route('assinatura.index') }}" class="fw-bold ms-1">Escolher plano</a>
        </div>
    @endif

    <div class="row g-3 mb-4 motion-div">
        <div class="col-md-3">
            <a href="{{ route('produtos.index') }}" class="quick-action">
                <div class="icon-soft"><i class="bi bi-box-seam"></i></div>
                <strong>Novo produto</strong>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('vendas.index') }}" class="quick-action">
                <div class="icon-soft"><i class="bi bi-cart-plus"></i></div>
                <strong>Nova venda</strong>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('clientes.index') }}" class="quick-action">
                <div class="icon-soft"><i class="bi bi-person-plus"></i></div>
                <strong>Novo cliente</strong>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('movimentacoes.index') }}" class="quick-action">
                <div class="icon-soft"><i class="bi bi-arrow-left-right"></i></div>
                <strong>Movimentação</strong>
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4 motion-div">
        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Faturamento Total</p>
                        <h3 class="fw-bold mb-0">R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</h3>
                    </div>
                    <div class="icon-soft"><i class="bi bi-cash-coin"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Lucro Total</p>
                        <h3 class="fw-bold text-success mb-0">R$ {{ number_format($lucroTotal, 2, ',', '.') }}</h3>
                    </div>
                    <div class="icon-soft"><i class="bi bi-graph-up-arrow"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Ticket Médio</p>
                        <h3 class="fw-bold mb-0">R$ {{ number_format($ticketMedio, 2, ',', '.') }}</h3>
                    </div>
                    <div class="icon-soft"><i class="bi bi-receipt"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Vendas Hoje</p>
                        <h3 class="fw-bold mb-0">{{ $vendasHoje }}</h3>
                    </div>
                    <div class="icon-soft"><i class="bi bi-cart-check"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4 motion-div">
        <div class="col-md-3">
            <div class="kpi-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-soft"><i class="bi bi-box-seam"></i></div>
                    <div>
                        <p class="text-muted mb-0">Produtos Ativos</p>
                        <h4 class="fw-bold mb-0">{{ $totalProdutos }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kpi-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-soft"><i class="bi bi-people"></i></div>
                    <div>
                        <p class="text-muted mb-0">Clientes Ativos</p>
                        <h4 class="fw-bold mb-0">{{ $totalClientes }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kpi-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-soft"><i class="bi bi-bag-check"></i></div>
                    <div>
                        <p class="text-muted mb-0">Total de Vendas</p>
                        <h4 class="fw-bold mb-0">{{ $totalVendas }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kpi-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-soft"><i class="bi bi-exclamation-triangle"></i></div>
                    <div>
                        <p class="text-muted mb-0">Estoque Baixo</p>
                        <h4 class="fw-bold text-danger mb-0">{{ $estoqueBaixo }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4 motion-div">
        <div class="col-lg-6">
            <div class="premium-card h-100 p-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-bar-chart me-2 text-primary"></i>
                    Vendas dos últimos 7 dias
                </h5>

                <canvas id="graficoVendas" height="140"></canvas>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="premium-card h-100 p-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-activity me-2 text-success"></i>
                    Faturamento dos últimos 7 dias
                </h5>

                <canvas id="graficoFaturamento" height="140"></canvas>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4 motion-div">
        <div class="col-lg-6">
            <div class="premium-card h-100 p-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-trophy me-2 text-warning"></i>
                    Top 5 produtos vendidos
                </h5>

                @forelse($topProdutos as $index => $item)
                    <div class="rank-item">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rank-number">
                                #{{ $index + 1 }}
                            </div>
                            <div>
                                <strong>{{ $item->produto->nome ?? 'Produto removido' }}</strong>
                                <div class="text-muted small">Quantidade vendida</div>
                            </div>
                        </div>

                        <span class="badge bg-primary rounded-pill fs-6">
                            {{ $item->total_vendido }}
                        </span>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-box"></i>
                        Nenhum produto vendido ainda.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="col-lg-6">
            <div class="premium-card h-100 p-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-stars me-2 text-success"></i>
                    Top 5 clientes
                </h5>

                @forelse($topClientes as $index => $cliente)
                    <div class="rank-item">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rank-number">
                                #{{ $index + 1 }}
                            </div>

                            <div>
                                <strong>{{ $cliente->cliente->nome ?? 'Cliente removido' }}</strong>
                                <div class="text-muted small">
                                    {{ $cliente->total_compras }} compra(s)
                                </div>
                            </div>
                        </div>

                        <span class="fw-bold text-success">
                            R$ {{ number_format($cliente->total_gasto, 2, ',', '.') }}
                        </span>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-people"></i>
                        Nenhum cliente ranqueado ainda.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="premium-card p-4 motion-div">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
            <div>
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>
                    Últimas vendas
                </h5>
                <small class="text-muted">Vendas mais recentes da empresa.</small>
            </div>

            <a href="{{ route('vendas.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                Ver vendas
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle premium-table">
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
                            <td><strong>{{ $venda->cliente->nome ?? 'Consumidor final' }}</strong></td>
                            <td class="text-primary fw-bold">R$ {{ number_format($venda->total, 2, ',', '.') }}</td>
                            <td class="text-success fw-bold">R$ {{ number_format($venda->lucro_total, 2, ',', '.') }}</td>
                            <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
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
                    borderRadius: 10
                }]
            },
            options: {
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
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
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</div>