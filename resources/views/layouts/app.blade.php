<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>StockFlow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #0f172a;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
        }

        .sidebar .brand {
            padding: 24px;
            font-size: 22px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255,255,255,.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar .brand img {
    height: 70px;
    max-width: 210px;
    object-fit: contain;
    background: white;
    border-radius: 10px;
    padding: 6px;
}

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 24px;
            transition: .2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #1e293b;
            color: #fff;
        }

        .main {
            margin-left: 260px;
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
        }

        .content {
            padding: 28px;
        }
    </style>

    @livewireStyles
</head>

<body>

<aside class="sidebar">
    <div class="brand">
        @if(auth()->user()->empresa->logo)
            <img src="{{ asset('storage/' . auth()->user()->empresa->logo) }}" alt="Logo">
        @else
            <span><i class="bi bi-box-seam"></i> StockFlow</span>
        @endif
    </div>

    <nav class="mt-3">
        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ route('categorias.index') }}" class="{{ request()->is('categorias*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Categorias
        </a>

        <a href="{{ route('clientes.index') }}" class="{{ request()->is('clientes*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Clientes
        </a>

        <a href="{{ route('produtos.index') }}" class="{{ request()->is('produtos*') ? 'active' : '' }}">
            <i class="bi bi-box"></i> Produtos / Estoque
        </a>

        <a href="{{ route('movimentacoes.index') }}" class="{{ request()->is('movimentacoes*') ? 'active' : '' }}">
            <i class="bi bi-arrow-left-right"></i> Movimentações
        </a>

        <a href="{{ route('vendas.index') }}" class="{{ request()->is('vendas*') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i> Vendas
        </a>

        <a href="{{ route('relatorios.index') }}" class="{{ request()->is('relatorios*') ? 'active' : '' }}">
            <i class="bi bi-graph-up"></i> Relatórios
        </a>

        <a href="{{ route('assinatura.index') }}" class="{{ request()->is('assinatura*') ? 'active' : '' }}">
            <i class="bi bi-credit-card"></i> Plano e Assinatura
        </a>

        <a href="{{ route('configuracoes.index') }}" class="{{ request()->is('configuracoes*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Configurações
        </a>
    </nav>
</aside>

<div class="main">
    <header class="topbar">
        <div class="d-flex align-items-center gap-3">
            @if(auth()->user()->empresa->logo)
                <img src="{{ asset('storage/' . auth()->user()->empresa->logo) }}"
                     style="height:50px; max-width:160px; object-fit:contain;"
                     class="rounded border bg-white p-1">
            @endif

            <div>
                <strong>{{ auth()->user()->empresa->nome ?? 'Empresa' }}</strong>
                <small class="text-muted d-block">
                    Plano {{ ucfirst(auth()->user()->empresa->plano ?? 'Básico') }}
                </small>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <span class="text-muted">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Sair
                </button>
            </form>
        </div>
    </header>

    <main class="content">
        {{ $slot }}
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
@livewireScripts

</body>
</html>