<div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Relatórios</h1>
            <small class="text-muted">
                Indicadores da sua empresa
            </small>
        </div>

        <a href="{{ route('relatorios.pdf') }}" class="btn btn-success">
    <i class="bi bi-file-earmark-pdf"></i>
    Exportar PDF
</a>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <small class="text-muted">Faturamento Total</small>
                    <h3 class="fw-bold">
                        R$ {{ number_format($faturamentoTotal,2,',','.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <small class="text-muted">Lucro Total</small>
            <h3 class="fw-bold text-success">
                R$ {{ number_format($lucroTotal,2,',','.') }}
            </h3>
        </div>
    </div>
</div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <small class="text-muted">Vendas Hoje</small>
                    <h3 class="fw-bold">{{ $vendasHoje }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <small class="text-muted">Clientes</small>
                    <h3 class="fw-bold">{{ $clientes }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <small class="text-muted">Produtos</small>
                    <h3 class="fw-bold">{{ $produtos }}</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <small class="text-muted">Vendas do mês</small>
                    <h2>{{ $vendasMes }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <small class="text-muted">Estoque Baixo</small>
                    <h2>{{ $estoqueBaixo }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-white fw-bold">
            Últimas vendas
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Data</th>
                        <th>Lucro</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($ultimasVendas as $venda)
                        <tr>
                            <td>
                                {{ $venda->cliente->nome ?? 'Consumidor Final' }}
                            </td>

                            <td>
                                R$ {{ number_format($venda->total,2,',','.') }}
                            </td>

                            <td>
                                {{ $venda->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="text-success fw-bold">
    R$ {{ number_format($venda->lucro_total,2,',','.') }}
</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>