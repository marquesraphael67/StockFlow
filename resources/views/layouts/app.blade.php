<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>StockFlow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --blue: #2563eb;
            --blue-dark: #0f172a;
            --bg: #f8fafc;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e5e7eb;
            --card: rgba(255,255,255,.86);
        }

        * {
            transition: background-color .25s ease, color .25s ease, border-color .25s ease, box-shadow .25s ease;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top right, rgba(37,99,235,.18), transparent 32%),
                radial-gradient(circle at bottom left, rgba(37,99,235,.08), transparent 35%),
                #f8fafc;
        }

        .app-shell {
            width: 100%;
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 270px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 22px 14px;
            overflow-y: auto;
            overflow-x: hidden;
            background: rgba(255,255,255,.82);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(226,232,240,.9);
            box-shadow: 10px 0 30px rgba(15,23,42,.04);
            display: flex;
            flex-direction: column;
            z-index: 50;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .brand {
            height: 60px;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 0 13px;
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: 900;
            color: var(--blue);
            letter-spacing: -.7px;
        }

        .brand img {
            max-height: 52px;
            max-width: 200px;
            object-fit: contain;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background: linear-gradient(135deg, #0f172a, #2563eb);
            box-shadow: 0 12px 25px rgba(37,99,235,.25);
        }

        .menu-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 800;
            padding: 16px 14px 8px;
            letter-spacing: .7px;
        }

        .sidebar a {
            color: #64748b;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 600;
        }

        .sidebar a i {
            font-size: 18px;
        }

        .sidebar a:hover {
            background: #eff6ff;
            color: var(--blue);
            transform: translateX(3px);
        }

        .sidebar a.active {
            background: linear-gradient(135deg, #0f172a, #2563eb);
            color: white;
            box-shadow: 0 12px 28px rgba(37,99,235,.28);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 14px;
        }

        .logout-btn {
            width: 100%;
            border: 1px solid var(--border);
            background: white;
            border-radius: 14px;
            padding: 12px;
            color: #64748b;
            font-weight: 700;
        }

        .logout-btn:hover {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fecaca;
        }

        .main {
            margin-left: 270px;
            flex: 1;
            min-height: 100vh;
        }

        .topbar {
            height: 78px;
            background: rgba(255,255,255,.74);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(226,232,240,.9);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .page-content {
            padding: 32px;
        }

        .search-box {
            width: 350px;
            border: 1px solid rgba(226,232,240,.9);
            background: rgba(255,255,255,.75);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            padding: 11px 15px;
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
            border-radius: 10px;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 16px;
            background: linear-gradient(135deg, #0f172a, #2563eb);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            box-shadow: 0 12px 25px rgba(37,99,235,.22);
        }

        .btn {
            border-radius: 13px;
            font-weight: 700;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0f172a, #2563eb);
            border: 0;
            box-shadow: 0 10px 22px rgba(37,99,235,.22);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(37,99,235,.28);
        }

        .btn-light {
            background: rgba(255,255,255,.82);
            border: 1px solid #e5e7eb;
        }

        .card,
        .premium-card,
        .welcome-card,
        .section-card,
        .stock-card {
            background: var(--card);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.65);
            border-radius: 24px;
            box-shadow: 0 20px 45px rgba(15,23,42,.08);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(226,232,240,.85);
            border-radius: 24px 24px 0 0 !important;
        }

        .form-control,
        .form-select {
            border-radius: 14px;
            border: 1px solid #dbe3ef;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 .2rem rgba(37,99,235,.14);
        }

        .table thead th {
            color: #64748b;
            font-size: 13px;
            font-weight: 800;
            border-bottom: 1px solid #e5e7eb;
        }

        .table td {
            vertical-align: middle;
        }

        .soft-card {
            background: rgba(248,250,252,.85);
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            padding: 18px;
        }

        .gradient-panel {
            background: linear-gradient(135deg, #0f172a, #2563eb);
            color: white;
            border-radius: 26px;
            box-shadow: 0 24px 55px rgba(37,99,235,.22);
        }

        .trial-badge {
            background: #e8f1ff;
            color: #2563eb;
            border-radius: 999px;
            padding: 8px 14px;
            font-weight: 800;
            font-size: 13px;
        }

        .dropdown-menu {
            border-radius: 20px !important;
            border: 1px solid rgba(226,232,240,.9) !important;
            box-shadow: 0 25px 55px rgba(15,23,42,.15) !important;
        }

        body.dark-mode {
            background:
                radial-gradient(circle at top right, rgba(37,99,235,.22), transparent 32%),
                #0f172a !important;
            color: #e2e8f0;
        }

        body.dark-mode .main,
        body.dark-mode .page-content,
        body.dark-mode .app-shell {
            background: transparent !important;
        }

        body.dark-mode .sidebar,
        body.dark-mode .topbar {
            background: rgba(15,23,42,.82) !important;
            border-color: #1f2937 !important;
        }

        body.dark-mode .card,
        body.dark-mode .premium-card,
        body.dark-mode .welcome-card,
        body.dark-mode .section-card,
        body.dark-mode .stock-card,
        body.dark-mode .soft-card {
            background: rgba(30,41,59,.9) !important;
            color: #e2e8f0 !important;
            border-color: rgba(51,65,85,.9) !important;
            box-shadow: none !important;
        }

        body.dark-mode .card-header,
        body.dark-mode .bg-white {
            background: rgba(30,41,59,.9) !important;
            color: #e2e8f0 !important;
            border-color: #334155 !important;
        }

        body.dark-mode .text-muted {
            color: #94a3b8 !important;
        }

        body.dark-mode .sidebar a {
            color: #cbd5e1 !important;
        }

        body.dark-mode .sidebar a:hover {
            background: #1e293b !important;
            color: white !important;
        }

        body.dark-mode .sidebar a.active {
            background: linear-gradient(135deg, #1d4ed8, #2563eb) !important;
            color: white !important;
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select,
        body.dark-mode .search-box {
            background: #334155 !important;
            border-color: #475569 !important;
            color: white !important;
        }

        body.dark-mode .search-box input {
            color: white !important;
        }

        body.dark-mode .table,
        body.dark-mode .table tbody,
        body.dark-mode .table tr,
        body.dark-mode .table td {
            background: transparent !important;
            color: #e2e8f0 !important;
            border-color: #334155 !important;
        }

        body.dark-mode .table thead,
        body.dark-mode .table thead tr,
        body.dark-mode .table thead th {
            background: transparent !important;
            color: #cbd5e1 !important;
            border-color: #334155 !important;
        }

        body.dark-mode .btn-light,
        body.dark-mode .logout-btn {
            background: #1e293b !important;
            color: #e2e8f0 !important;
            border-color: #334155 !important;
        }

        body.dark-mode .dropdown-menu,
        body.dark-mode .dropdown-item {
            background: #1e293b !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .dropdown-item:hover {
            background: #334155 !important;
        }

        body.dark-mode .trial-badge {
            background: #334155 !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode hr,
        body.dark-mode .border-bottom {
            border-color: #334155 !important;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 84px;
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
                margin-left: 84px;
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
                <div class="brand-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
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

                    $assinatura = \App\Models\Assinatura::where('empresa_id', $empresa->id)->latest()->first();

                    $diasTrial = $assinatura && $assinatura->data_expiracao
                        ? max(0, ceil(now()->diffInHours($assinatura->data_expiracao, false) / 24))
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

                    if ($assinatura && $assinatura->status === 'trial' && $diasTrial !== null && $diasTrial <= 3) {
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

                    <div class="dropdown-menu dropdown-menu-end p-0"
                         style="width: 350px; overflow: hidden;">
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
    const body = document.body;
    const button = document.getElementById('toggleTheme');
    const icon = document.getElementById('themeIcon');

    function aplicarTema(tema) {
        if (tema === 'dark') {
            body.classList.add('dark-mode');
            if (icon) icon.className = 'bi bi-sun';
        } else {
            body.classList.remove('dark-mode');
            if (icon) icon.className = 'bi bi-moon-stars';
        }

        localStorage.setItem('theme', tema);
    }

    aplicarTema(localStorage.getItem('theme') || 'light');

    if (button) {
        button.addEventListener('click', function () {
            const novoTema = body.classList.contains('dark-mode') ? 'light' : 'dark';
            aplicarTema(novoTema);
        });
    }
});
</script>

</body>
</html>