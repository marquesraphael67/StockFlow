<div>
    <style>
        .motion-div{animation:fadeUp .45s ease both}
        @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
        .premium-hero{background:linear-gradient(135deg,#0f172a,#2563eb);color:#fff;border-radius:30px;padding:32px;box-shadow:0 24px 60px rgba(37,99,235,.28)}
        .premium-badge{display:inline-flex;gap:8px;align-items:center;padding:8px 14px;border-radius:999px;background:rgba(255,255,255,.16);font-size:.82rem;font-weight:700}
        .premium-card,.kpi-card{background:rgba(255,255,255,.88);border:1px solid rgba(226,232,240,.9);border-radius:28px;box-shadow:0 18px 45px rgba(15,23,42,.08);backdrop-filter:blur(18px)}
        .kpi-card{padding:22px;height:100%}
        .icon-soft{width:50px;height:50px;border-radius:18px;display:grid;place-items:center;background:#eff6ff;color:#2563eb;font-size:1.5rem}
        .premium-table thead th{color:#64748b;font-size:.78rem;text-transform:uppercase;letter-spacing:.05em}
        .premium-table tbody td{padding:18px 10px}
        .premium-table tbody tr:hover{background:rgba(37,99,235,.045)}
        body.dark-mode .premium-card,body.dark-mode .kpi-card{background:rgba(15,23,42,.88);border-color:#334155;color:#e5e7eb}
    </style>

    <div class="premium-hero mb-4 motion-div">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
            <div>
                <span class="premium-badge">
                    <i class="bi bi-graph-up-arrow"></i>
                    Inteligência comercial
                </span>

                <h1 class="fw-bold mt-3 mb-2">Relatórios</h1>
                <p class="mb-0 opacity-75">Acompanhe faturamento, lucro, vendas, clientes e estoque.</p>
            </div>

            <a href="{{ route('relatorios.pdf') }}" class="btn btn-light rounded-pill px-4 fw-semibold">
                <i class="bi bi-file-earmark-pdf me-2"></i>
                Exportar PDF
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4 motion-div">
        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Faturamento Total</p>
                        <h3 class="fw-bold mb-0">R$ {{ number_format($faturamentoTotal,2,',','.') }}</h3>
                    </div>
                    <div class="icon-soft"><i class="bi bi-cash-stack"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Lucro Total</p>
                        <h3 class="fw-bold text-success mb-0">R$ {{ number_format($lucroTotal,2,',','.') }}</h3>
                    </div>
                    <div class="icon-soft"><i class="bi bi-graph-up-arrow"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Vendas Hoje</p>
                        <h3 class="fw-bold mb-0">{{ $vendasHoje }}</h3>
                    </div>
                    <div class="icon-soft"><i class="bi bi-cart-check"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Clientes</p>
                        <h3 class="fw-bold mb-0">{{ $clientes }}</h3>
                    </div>
                    <div class="icon-soft"><i class="bi bi-people"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Produtos</p>
                        <h3 class="fw-bold mb-0">{{ $produtos }}</h3>
                    </div>
                    <div class="icon-soft"><i class="bi bi-box-seam"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Vendas do mês</p>
                        <h3 class="fw-bold mb-0">{{ $vendasMes }}</h3>
                    </div>
                    <div class="icon-soft"><i class="bi bi-calendar-check"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Estoque Baixo</p>
                        <h3 class="fw-bold text-danger mb-0">{{ $estoqueBaixo }}</h3>
                    </div>
                    <div class="icon-soft"><i class="bi bi-exclamation-triangle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="premium-card p-4 motion-div">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="icon-soft">
                <i class="bi bi-receipt"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0">Últimas vendas</h5>
                <small class="text-muted">Movimentações comerciais recentes.</small>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle premium-table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Data</th>
                        <th>Lucro</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ultimasVendas as $venda)
                        <tr>
                            <td><strong>{{ $venda->cliente->nome ?? 'Consumidor Final' }}</strong></td>
                            <td class="text-primary fw-bold">R$ {{ number_format($venda->total,2,',','.') }}</td>
                            <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-success fw-bold">R$ {{ number_format($venda->lucro_total,2,',','.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                <i class="bi bi-receipt fs-1 d-block mb-2"></i>
                                Nenhuma venda encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>