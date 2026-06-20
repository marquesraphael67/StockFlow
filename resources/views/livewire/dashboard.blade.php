<div>
    <div class="alert alert-primary border-0 shadow-sm">
        <i class="bi bi-gift"></i>
        Seu teste grátis expira em
        <strong>{{ auth()->user()->empresa->trial_ends_at->diffInDays(now()) }} dias</strong>.
        Plano atual: <strong>{{ ucfirst(auth()->user()->empresa->plano) }}</strong>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Dashboard</h1>
            <p class="text-muted mb-0">
                Bem-vindo, {{ auth()->user()->name }} 👋
            </p>
        </div>

        <a href="{{ route('relatorios.pdf') }}" class="btn btn-success">
            <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-cash-coin fs-2 text-primary"></i>
                    <p class="text-muted mt-3 mb-1">Faturamento Total</p>
                    <h3 class="fw-bold">R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-graph-up-arrow fs-2 text-success"></i>
                    <p class="text-muted mt-3 mb-1">Lucro Total</p>
                    <h3 class="fw-bold text-success">R$ {{ number_format($lucroTotal, 2, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-cart-check fs-2 text-warning"></i>
                    <p class="text-muted mt-3 mb-1">Vendas Hoje</p>
                    <h3 class="fw-bold">{{ $vendasHoje }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-exclamation-triangle fs-2 text-danger"></i>
                    <p class="text-muted mt-3 mb-1">Estoque Baixo</p>
                    <h3 class="fw-bold">{{ $estoqueBaixo }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-1">Produtos Ativos</p>
                    <h2 class="fw-bold">{{ $totalProdutos }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-1">Clientes Ativos</p>
                    <h2 class="fw-bold">{{ $totalClientes }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-1">Total de Vendas</p>
                    <h2 class="fw-bold">{{ $totalVendas }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">
                    Vendas dos últimos 7 dias
                </div>
                <div class="card-body">
                    <canvas id="graficoVendas"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">
                    Faturamento dos últimos 7 dias
                </div>
                <div class="card-body">
                    <canvas id="graficoFaturamento"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white fw-bold">
            Últimas vendas
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
                            <td>{{ $venda->cliente->nome ?? 'Consumidor final' }}</td>
                            <td>R$ {{ number_format($venda->total, 2, ',', '.') }}</td>
                            <td class="text-success fw-bold">R$ {{ number_format($venda->lucro_total, 2, ',', '.') }}</td>
                            <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
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
                    data: vendas7Dias.map(item => item.total)
                }]
            }
        });

        new Chart(document.getElementById('graficoFaturamento'), {
            type: 'line',
            data: {
                labels: faturamento7Dias.map(item => item.dia),
                datasets: [{
                    label: 'Faturamento R$',
                    data: faturamento7Dias.map(item => item.total)
                }]
            }
        });
    </script>
</div>