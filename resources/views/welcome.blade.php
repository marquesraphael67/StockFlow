<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>StockFlow - Gestão de Estoque</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
        }

        .navbar {
            height: 78px;
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid #e5e7eb;
        }

        .brand {
            font-weight: 900;
            color: #2563eb;
            font-size: 22px;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .btn {
            border-radius: 12px;
            font-weight: 600;
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 115px 0 100px;
            background: #f8fafc;
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 520px;
            height: 520px;
            background: rgba(37, 99, 235, .08);
            border-radius: 50%;
            top: -260px;
            right: -160px;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            background: rgba(37, 99, 235, .06);
            border-radius: 50%;
            bottom: -230px;
            left: -160px;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            background: #e8f1ff;
            color: #2563eb;
            border: 1px solid #cfe0ff;
            border-radius: 999px;
            padding: 9px 16px;
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .hero h1 {
            font-size: 62px;
            line-height: 1.04;
            font-weight: 900;
            letter-spacing: -2.2px;
            color: #0f172a;
        }

        .hero h1 span {
            color: #2563eb;
        }

        .hero-text {
            font-size: 18px;
            color: #475569;
            line-height: 1.7;
            max-width: 640px;
        }

        .hero-stats {
            display: flex;
            gap: 34px;
            margin-top: 38px;
        }

        .hero-stats h3 {
            font-weight: 900;
            margin: 0;
            color: #0f172a;
        }

        .hero-stats small {
            color: #64748b;
        }

        .preview-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 30px;
            padding: 14px;
            box-shadow: 0 30px 80px rgba(15, 23, 42, .12);
        }

        .preview-inner {
            background: #f8fafc;
            border-radius: 24px;
            padding: 22px;
        }

        .preview-top {
            background: #ffffff;
            border-radius: 18px;
            padding: 18px;
            border: 1px solid #e5e7eb;
        }

        .mini-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 17px;
            height: 100%;
        }

        .mini-card small {
            color: #64748b;
            font-weight: 600;
        }

        .mini-card h4 {
            font-weight: 900;
            margin: 4px 0 0;
        }

        .fake-chart {
            height: 145px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 18px;
            display: flex;
            align-items: end;
            gap: 10px;
        }

        .bar {
            flex: 1;
            border-radius: 10px 10px 0 0;
            background: #2563eb;
        }

        .bar:nth-child(2),
        .bar:nth-child(5) {
            background: #22c55e;
        }

        .section {
            padding: 85px 0;
        }

        .section-title {
            font-size: 40px;
            font-weight: 900;
            letter-spacing: -1.4px;
        }

        .section-subtitle {
            color: #64748b;
            font-size: 17px;
        }

        .feature-card,
        .plan-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 26px;
            box-shadow: 0 14px 35px rgba(15, 23, 42, .06);
            transition: .2s;
            height: 100%;
        }

        .feature-card:hover,
        .plan-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 22px 50px rgba(15, 23, 42, .10);
        }

        .icon-box {
            width: 62px;
            height: 62px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 20px;
        }

        .bg-soft-primary { background: #e8f1ff; color: #2563eb; }
        .bg-soft-success { background: #e9f8ef; color: #198754; }
        .bg-soft-warning { background: #fff4df; color: #f59f00; }
        .bg-soft-danger { background: #ffecec; color: #dc3545; }

        .plans-section {
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
        }

        .plan-card {
            padding: 32px;
        }

        .plan-pro {
            border: 2px solid #2563eb;
            position: relative;
        }

        .badge-popular {
            background: #2563eb;
            color: white;
            border-radius: 999px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 14px;
        }

        .price {
            font-size: 46px;
            font-weight: 900;
            color: #2563eb;
            letter-spacing: -1.5px;
        }

        .check {
            color: #198754;
            margin-right: 8px;
        }

        .cta-box {
            background: #0f172a;
            color: white;
            border-radius: 32px;
            padding: 50px;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .25);
        }

        footer {
            background: #ffffff;
            color: #64748b;
            border-top: 1px solid #e5e7eb;
        }

        @media(max-width: 992px) {
            .hero h1 {
                font-size: 44px;
            }

            .hero-stats {
                flex-wrap: wrap;
            }

            .section-title {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="brand" href="{{ route('home') }}">
            <i class="bi bi-box-seam"></i> StockFlow
        </a>

        <div class="d-flex gap-2">
            <a href="#planos" class="btn btn-outline-primary">Planos</a>

            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Meu painel</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary">Entrar</a>
                <a href="{{ route('cadastro') }}" class="btn btn-primary">Criar conta</a>
            @endauth
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="hero-badge mb-4">
                    <i class="bi bi-stars"></i>
                    SaaS de estoque para pequenos negócios
                </div>

                <h1>
                    Controle seu estoque com um sistema <span>bonito, rápido e profissional.</span>
                </h1>

                <p class="hero-text mt-4">
                    O StockFlow ajuda comércios a organizar produtos, clientes, vendas,
                    movimentações, lucro e relatórios em uma plataforma moderna e simples de usar.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="#planos" class="btn btn-primary btn-lg px-4 py-3">
                        Começar teste grátis
                    </a>

                    <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4 py-3 border">
                        Já tenho conta
                    </a>
                </div>

                <div class="hero-stats">
                    <div>
                        <h3>7 dias</h3>
                        <small>teste grátis</small>
                    </div>

                    <div>
                        <h3>Multiempresa</h3>
                        <small>dados separados por empresa</small>
                    </div>

                    <div>
                        <h3>PDF</h3>
                        <small>relatórios profissionais</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="preview-card">
                    <div class="preview-inner">
                        <div class="preview-top mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Dashboard StockFlow</strong>
                                    <small class="text-muted d-block">Resumo da empresa</small>
                                </div>
                                <span class="badge bg-success">Online</span>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <div class="mini-card">
                                    <small>Faturamento</small>
                                    <h4>R$ 8.450</h4>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mini-card">
                                    <small>Lucro</small>
                                    <h4 class="text-success">R$ 2.930</h4>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mini-card">
                                    <small>Produtos</small>
                                    <h4>320</h4>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mini-card">
                                    <small>Clientes</small>
                                    <h4>87</h4>
                                </div>
                            </div>
                        </div>

                        <div class="fake-chart">
                            <div class="bar" style="height: 35%"></div>
                            <div class="bar" style="height: 55%"></div>
                            <div class="bar" style="height: 42%"></div>
                            <div class="bar" style="height: 78%"></div>
                            <div class="bar" style="height: 64%"></div>
                            <div class="bar" style="height: 88%"></div>
                            <div class="bar" style="height: 51%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Tudo que seu comércio precisa</h2>
            <p class="section-subtitle">
                Controle simples, visual moderno e dados importantes em tempo real.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="feature-card p-4">
                    <div class="icon-box bg-soft-primary">
                        <i class="bi bi-box"></i>
                    </div>
                    <h5 class="fw-bold">Produtos</h5>
                    <p class="text-muted mb-0">
                        Cadastre SKU, preços, estoque mínimo e arquive produtos sem excluir.
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-card p-4">
                    <div class="icon-box bg-soft-success">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5 class="fw-bold">Clientes</h5>
                    <p class="text-muted mb-0">
                        Organize clientes, telefone, CPF/CNPJ, endereço e histórico de compras.
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-card p-4">
                    <div class="icon-box bg-soft-warning">
                        <i class="bi bi-cart-check"></i>
                    </div>
                    <h5 class="fw-bold">Vendas</h5>
                    <p class="text-muted mb-0">
                        Venda com carrinho, desconto, baixa automática de estoque e lucro.
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-card p-4">
                    <div class="icon-box bg-soft-danger">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </div>
                    <h5 class="fw-bold">Relatórios</h5>
                    <p class="text-muted mb-0">
                        Acompanhe faturamento, lucro, estoque baixo e exporte PDF profissional.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="planos" class="section plans-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Escolha o plano ideal</h2>
            <p class="section-subtitle">
                Comece com 7 dias grátis. Depois escolha PIX ou cartão.
            </p>
        </div>

        <div class="row g-4">
            @php
                $planos = [
                    'basico' => ['Básico', 39, ['1 usuário', 'Até 500 produtos', 'Controle de estoque']],
                    'pro' => ['Pro', 79, ['Até 5 usuários', 'Produtos ilimitados', 'Dashboard avançado', 'Relatórios']],
                    'premium' => ['Premium', 149, ['Usuários ilimitados', 'Relatórios PDF', 'Dashboard premium', 'Suporte prioritário']],
                ];
            @endphp

            @foreach($planos as $key => $plano)
                <div class="col-md-4">
                    <div class="plan-card {{ $key === 'pro' ? 'plan-pro' : '' }}">
                        <div>
                            @if($key === 'pro')
                                <span class="badge-popular">Mais escolhido</span>
                            @endif

                            <h4 class="fw-bold">{{ $plano[0] }}</h4>

                            <div class="price">
                                R$ {{ $plano[1] }}
                            </div>

                            <p class="text-muted">por mês</p>
                        </div>

                        <hr>

                        @foreach($plano[2] as $item)
                            <p>
                                <i class="bi bi-check-circle-fill check"></i>
                                {{ $item }}
                            </p>
                        @endforeach

                        @auth
                            <a href="{{ route('checkout') }}?plano={{ $key }}" class="btn btn-primary w-100 mt-3 py-3">
                                Assinar plano
                            </a>
                        @else
                            <a href="{{ route('cadastro') }}?plano={{ $key }}" class="btn btn-primary w-100 mt-3 py-3">
                                Criar conta e começar
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-box text-center">
            <h2 class="fw-bold mb-3">Pronto para organizar seu estoque?</h2>
            <p class="mb-4 opacity-75">
                Crie sua conta, escolha um plano e teste o StockFlow grátis por 7 dias.
            </p>

            <a href="{{ route('cadastro') }}" class="btn btn-light btn-lg px-5 py-3">
                Começar agora
            </a>
        </div>
    </div>
</section>

<footer class="py-4 text-center">
    <div class="container">
        <strong>StockFlow</strong>
        <p class="mb-0 mt-1">© {{ date('Y') }} - Sistema SaaS de gestão de estoque.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>