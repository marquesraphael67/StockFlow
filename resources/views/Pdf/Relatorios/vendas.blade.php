<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório StockFlow</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1f2937;
            background: #ffffff;
        }

        .header {
            background: #0d6efd;
            color: white;
            padding: 24px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 12px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin: 25px 0 10px;
            color: #0d6efd;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 6px;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 14px;
            margin-bottom: 15px;
        }

        .grid {
            width: 100%;
            margin-bottom: 20px;
        }

        .card {
            width: 23%;
            display: inline-block;
            vertical-align: top;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
            margin-right: 1%;
        }

        .card small {
            color: #6b7280;
        }

        .card h3 {
            margin: 6px 0 0;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        th {
            background: #0f172a;
            color: white;
            padding: 8px;
            font-size: 11px;
            text-align: left;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
        }

        .badge {
            padding: 4px 7px;
            border-radius: 5px;
            color: white;
            font-size: 10px;
        }

        .success {
            background: #198754;
        }

        .danger {
            background: #dc3545;
        }

        .text-success {
            color: #198754;
            font-weight: bold;
        }

        .text-danger {
            color: #dc3545;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 10px;
        }
    </style>
</head>

<body>

<div class="header">
    <h1>StockFlow</h1>
    <p>Relatório completo de vendas, faturamento, lucro e estoque</p>
</div>

<div class="info-box">
    <strong>Empresa:</strong> {{ $empresa->nome }} <br>
    <strong>E-mail:</strong> {{ $empresa->email }} <br>
    <strong>Telefone:</strong> {{ $empresa->telefone ?? '-' }} <br>
    <strong>CPF/CNPJ:</strong> {{ $empresa->cpf_cnpj ?? '-' }} <br>
    <strong>Endereço:</strong>
    {{ $empresa->endereco ?? '-' }},
    {{ $empresa->numero ?? '-' }} -
    {{ $empresa->bairro ?? '-' }},
    {{ $empresa->cidade ?? '-' }}/{{ $empresa->estado ?? '-' }} <br>
    <strong>Plano:</strong> {{ ucfirst($empresa->plano) }} |
    <strong>Status:</strong> {{ ucfirst($empresa->status) }} <br>
    <strong>Gerado por:</strong> {{ $usuario->name }} |
    <strong>Data:</strong> {{ $dataGeracao }}
</div>

<div class="section-title">Resumo Geral</div>

<div class="grid">
    <div class="card">
        <small>Faturamento</small>
        <h3>R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</h3>
    </div>

    <div class="card">
        <small>Lucro Total</small>
        <h3 class="text-success">R$ {{ number_format($lucroTotal, 2, ',', '.') }}</h3>
    </div>

    <div class="card">
        <small>Total de Vendas</small>
        <h3>{{ $totalVendas }}</h3>
    </div>

    <div class="card">
        <small>Clientes Ativos</small>
        <h3>{{ $totalClientes }}</h3>
    </div>
</div>

<div class="section-title">Vendas Realizadas</div>

<table>
    <thead>
        <tr>
            <th>Data</th>
            <th>Cliente</th>
            <th>Produtos</th>
            <th>Total</th>
            <th>Lucro</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @forelse($vendas as $venda)
            <tr>
                <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>

                <td>{{ $venda->cliente->nome ?? 'Consumidor Final' }}</td>

                <td>
                    @foreach($venda->itens as $item)
                        {{ $item->produto->nome ?? '-' }}
                        x{{ $item->quantidade }}
                        <br>
                    @endforeach
                </td>

                <td>R$ {{ number_format($venda->total, 2, ',', '.') }}</td>

                <td class="text-success">
                    R$ {{ number_format($venda->lucro_total, 2, ',', '.') }}
                </td>

                <td>
                    <span class="badge success">
                        {{ ucfirst($venda->status) }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Nenhuma venda registrada.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="section-title">Produtos com Estoque Baixo</div>

<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Estoque Atual</th>
            <th>Estoque Mínimo</th>
            <th>Situação</th>
        </tr>
    </thead>

    <tbody>
        @forelse($estoqueBaixo as $produto)
            <tr>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->estoque }}</td>
                <td>{{ $produto->estoque_minimo }}</td>
                <td>
                    <span class="badge danger">Estoque baixo</span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Nenhum produto com estoque baixo.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    Relatório gerado automaticamente pelo StockFlow.
</div>

</body>
</html>