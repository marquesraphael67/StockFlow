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
            background: #f4f7fb;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            color: #0f172a;
        }

        .app-shell {
            width: 100%;
            min-height: 100vh;
            display: flex;
            background: #f4f7fb;
        }

        .sidebar {
    width: 260px;
    height: 100vh;
    background: #ffffff;
    border-right: 1px solid #e5e7eb;
    padding: 22px 14px;
    display: flex;
    flex-direction: column;
    position: fixed;
    left: 0;
    top: 0;
    overflow-y: auto;
    overflow-x: hidden;
}

.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-track {
    background: transparent;
}

        .brand {
            height: 58px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 12px;
            margin-bottom: 22px;
            font-weight: 800;
            color: #2563eb;
            font-size: 21px;
        }

        .brand img {
            max-height: 50px;
            max-width: 190px;
            object-fit: contain;
        }

        .menu-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 700;
            padding: 14px 14px 8px;
        }

        .sidebar a {
            color: #64748b;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 5px;
            font-size: 14px;
            transition: .2s;
        }

        .sidebar a i {
            font-size: 17px;
        }

        .sidebar a:hover {
            background: #eff6ff;
            color: #2563eb;
        }

        .sidebar a.active {
            background: #2563eb;
            color: #ffffff;
            box-shadow: 0 8px 18px rgba(37, 99, 235, .22);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 14px;
        }

        .logout-btn {
            width: 100%;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            border-radius: 12px;
            padding: 11px;
            color: #64748b;
            transition: .2s;
        }

        .logout-btn:hover {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fecaca;
        }

        .main {
            margin-left: 260px;
            flex: 1;
            min-height: 100vh;
            background: #f4f7fb;
        }

        .topbar {
            height: 76px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .page-content {
            padding: 30px;
        }

        .search-box {
            width: 340px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            border-radius: 14px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #94a3b8;
        }

        .search-box input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            font-size: 14px;
        }

        .company-logo-mini {
            height: 42px;
            max-width: 145px;
            object-fit: contain;
            border-radius: 8px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .card {
            border-radius: 18px;
            border: 0;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .06);
        }

        .btn,
        .form-control,
        .form-select {
            border-radius: 12px;
        }

        .table thead th {
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
        }

        body.dark-mode {
    background: #0f172a !important;
    color: #e2e8f0;
}

body.dark-mode .app-shell,
body.dark-mode .main,
body.dark-mode .page-content {
    background: #0f172a !important;
}

body.dark-mode .sidebar {
    background: #111827 !important;
    border-color: #1f2937 !important;
}

body.dark-mode .topbar {
    background: #111827 !important;
    border-color: #1f2937 !important;
}

body.dark-mode .card {
    background: #1e293b !important;
    color: white !important;
    box-shadow: none !important;
}

body.dark-mode .table {
    color: white !important;
}

body.dark-mode .table thead th {
    color: #cbd5e1 !important;
}

body.dark-mode .sidebar a {
    color: #cbd5e1 !important;
}

body.dark-mode .sidebar a:hover {
    background: #1e293b !important;
}

body.dark-mode .sidebar a.active {
    background: #2563eb !important;
    color: white !important;
}

body.dark-mode .text-muted {
    color: #94a3b8 !important;
}

body.dark-mode .form-control,
body.dark-mode .form-select {
    background: #334155 !important;
    border-color: #475569 !important;
    color: white !important;
}

body.dark-mode .search-box {
    background: #334155 !important;
    border-color: #475569 !important;
}

body.dark-mode .search-box input {
    color: white !important;
}

body.dark-mode .logout-btn {
    background: #1e293b !important;
    color: white !important;
    border-color: #334155 !important;
}

body.dark-mode .card-header {
    background: #1e293b !important;
    color: #e2e8f0 !important;
    border-color: #334155 !important;
}

body.dark-mode .table,
body.dark-mode .table tbody,
body.dark-mode .table tr,
body.dark-mode .table td {
    background: #1e293b !important;
    color: #e2e8f0 !important;
    border-color: #334155 !important;
}

body.dark-mode .table thead,
body.dark-mode .table thead tr,
body.dark-mode .table thead th {
    background: #0f172a !important;
    color: #cbd5e1 !important;
    border-color: #334155 !important;
}

body.dark-mode .btn-light {
    background: #1e293b !important;
    color: #e2e8f0 !important;
    border-color: #334155 !important;
}

body.dark-mode .bg-white {
    background: #1e293b !important;
    color: #e2e8f0 !important;
}

body.dark-mode hr,
body.dark-mode .border-bottom {
    border-color: #334155 !important;
}

body.dark-mode .dropdown-menu {
    background: #1e293b !important;
    color: #e2e8f0 !important;
}

body.dark-mode .dropdown-item {
    color: #e2e8f0 !important;
    background: #1e293b !important;
}

body.dark-mode .dropdown-item:hover {
    background: #334155 !important;
}

body.dark-mode .dropdown-menu .bg-white {
    background: #111827 !important;
}
body.dark-mode .welcome-card {
    background: #1e293b !important;
    color: #e2e8f0 !important;
}

body.dark-mode .trial-badge {
    background: #334155 !important;
    color: #e2e8f0 !important;
}

body.dark-mode .bg-white {
    background: #1e293b !important;
    color: #e2e8f0 !important;
}

body.dark-mode .card-header {
    background: #1e293b !important;
    color: #e2e8f0 !important;
    border-color: #334155 !important;
}

body.dark-mode .premium-card {
    background: #1e293b !important;
    color: #e2e8f0 !important;
}

body.dark-mode .welcome-card h1,
body.dark-mode .welcome-card p {
    color: #e2e8f0 !important;
}

* {
    transition:
        background-color .25s ease,
        color .25s ease,
        border-color .25s ease;
}

        @media (max-width: 992px) {
            .sidebar {
                width: 82px;
                padding: 18px 10px;
            }

            .brand span,
            .sidebar a span,
            .menu-label,
            .sidebar-footer {
                display: none;
            }

            .sidebar a {
                justify-content: center;
                padding: 13px;
            }

            .main {
                margin-left: 82px;
            }

            .search-box {
                display: none;
            }

            .topbar {
                padding: 0 18px;
            }

            .page-content {
                padding: 18px;
            }

        }
    </style>

    @livewireStyles
</head>

<body>

<div class="app-shell">
    
    <aside class="sidebar">
        
        <div class="brand">
            @if(auth()->user()->empresa->logo)
                <img src="{{ asset('storage/' . auth()->user()->empresa->logo) }}" alt="Logo">
            @else
                <i class="bi bi-box-seam"></i>
                <span>StockFlow</span>
            @endif
        </div>
        

        <div class="menu-label">Principal</div>

        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('produtos.index') }}" class="{{ request()->is('produtos*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i>
            <span>Produtos</span>
        </a>

        <a href="{{ route('vendas.index') }}" class="{{ request()->is('vendas*') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i>
            <span>Vendas</span>
        </a>

        <a href="{{ route('clientes.index') }}" class="{{ request()->is('clientes*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            <span>Clientes</span>
        </a>

        <div class="menu-label">Estoque</div>

        <a href="{{ route('categorias.index') }}" class="{{ request()->is('categorias*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i>
            <span>Categorias</span>
        </a>

        <a href="{{ route('movimentacoes.index') }}" class="{{ request()->is('movimentacoes*') ? 'active' : '' }}">
            <i class="bi bi-arrow-left-right"></i>
            <span>Movimentações</span>
        </a>

        <div class="menu-label">Gestão</div>

        <a href="{{ route('relatorios.index') }}" class="{{ request()->is('relatorios*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i>
            <span>Relatórios</span>
        </a>

        @if(auth()->user()->tipo === 'admin')
            <a href="{{ route('usuarios.index') }}" class="{{ request()->is('usuarios*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i>
                <span>Usuários</span>
            </a>

            <a href="{{ route('assinatura.index') }}" class="{{ request()->is('assinatura*') ? 'active' : '' }}">
                <i class="bi bi-credit-card"></i>
                <span>Assinatura</span>
            </a>

            <a href="{{ route('configuracoes.index') }}" class="{{ request()->is('configuracoes*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                <span>Configurações</span>
            </a>
        @endif

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Sair
                </button>
            </form>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                @if(auth()->user()->empresa->logo)
                    <img src="{{ asset('storage/' . auth()->user()->empresa->logo) }}"
                         class="company-logo-mini"
                         alt="Logo">
                @endif

                <div>
                    <strong>{{ auth()->user()->empresa->nome ?? 'Empresa' }}</strong>
                    <small class="text-muted d-block">
                        Plano {{ ucfirst(auth()->user()->empresa->plano ?? 'Básico') }}
                    </small>
                </div>
            </div>

            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Buscar no sistema...">
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-globe"></i>
                </a>

                @php
    $empresa = auth()->user()->empresa;

    $estoqueBaixoCount = \App\Models\Produto::where('empresa_id', auth()->user()->empresa_id)
        ->where('ativo', true)
        ->whereColumn('estoque', '<=', 'estoque_minimo')
        ->count();

    $diasTrial = $empresa->trial_ends_at
        ? now()->diffInDays($empresa->trial_ends_at, false)
        : null;

    $usuariosCount = \App\Models\User::where('empresa_id', auth()->user()->empresa_id)->count();

    $notificacoes = [];

    if ($estoqueBaixoCount > 0) {
        $notificacoes[] = [
            'tipo' => 'danger',
            'icone' => 'bi-exclamation-triangle',
            'titulo' => 'Estoque baixo',
            'texto' => $estoqueBaixoCount . ' produto(s) precisam de atenção.',
            'link' => route('produtos.index')
        ];
    }

    if ($diasTrial !== null && $diasTrial <= 3 && $empresa->status === 'trial') {
        $notificacoes[] = [
            'tipo' => 'warning',
            'icone' => 'bi-clock',
            'titulo' => 'Trial expirando',
            'texto' => 'Seu teste grátis expira em ' . $diasTrial . ' dia(s).',
            'link' => route('assinatura.index')
        ];
    }

    if ($empresa->plano === 'basico' && $usuariosCount >= 1) {
        $notificacoes[] = [
            'tipo' => 'primary',
            'icone' => 'bi-person',
            'titulo' => 'Limite do plano',
            'texto' => 'O plano Básico permite apenas 1 usuário.',
            'link' => route('assinatura.index')
        ];
    }

    if ($empresa->plano === 'pro' && $usuariosCount >= 5) {
        $notificacoes[] = [
            'tipo' => 'primary',
            'icone' => 'bi-people',
            'titulo' => 'Limite do plano',
            'texto' => 'O plano Pro permite até 5 usuários.',
            'link' => route('assinatura.index')
        ];
    }
@endphp

<div class="dropdown">
    <button class="btn btn-light btn-sm position-relative" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>

        @if(count($notificacoes) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ count($notificacoes) }}
            </span>
        @endif
    </button>

    <div class="dropdown-menu dropdown-menu-end p-0 shadow border-0"
         style="width: 340px; border-radius: 16px; overflow: hidden;">
        
        <div class="p-3 border-bottom bg-white">
            <strong>Notificações</strong>
            <small class="text-muted d-block">Alertas importantes do sistema</small>
        </div>

        @forelse($notificacoes as $notificacao)
            <a href="{{ $notificacao['link'] }}" class="dropdown-item p-3 border-bottom">
                <div class="d-flex gap-3">
                    <div class="text-{{ $notificacao['tipo'] }}">
                        <i class="bi {{ $notificacao['icone'] }} fs-4"></i>
                    </div>

                    <div>
                        <strong>{{ $notificacao['titulo'] }}</strong>
                        <div class="text-muted small">
                            {{ $notificacao['texto'] }}
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="p-4 text-center text-muted">
                <i class="bi bi-check-circle fs-2 text-success"></i>
                <p class="mb-0 mt-2">Nenhuma notificação no momento.</p>
            </div>
        @endforelse
    </div>
</div>

                <button type="button" id="toggleTheme" class="btn btn-light btn-sm">
    <i id="themeIcon" class="bi bi-moon-stars"></i>
</button>

                <div class="text-end d-none d-md-block">
                    <strong>{{ auth()->user()->name }}</strong>
                    <small class="text-muted d-block">
                        {{ ucfirst(auth()->user()->tipo ?? 'Usuário') }}
                    </small>
                </div>
                
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        <section class="page-content">
            {{ $slot }}
        </section>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
@livewireScripts

<script>
document.addEventListener('DOMContentLoaded', function () {

    const theme = localStorage.getItem('theme');

    if (theme === 'dark') {
        document.body.classList.add('dark-mode');
    }

    document.getElementById('toggleTheme').addEventListener('click', function () {

        document.body.classList.toggle('dark-mode');

        if(document.body.classList.contains('dark-mode')){
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });
});
</script>

</body>
</html>

