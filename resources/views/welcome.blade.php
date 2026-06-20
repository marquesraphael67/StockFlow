<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>StockFlow - Gestão de Estoque</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .hero {
            padding: 90px 0;
            background: linear-gradient(135deg, #0d6efd, #052c65);
            color: white;
        }

        .plan-card {
            transition: .2s;
            border: none;
        }

        .plan-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
            <i class="bi bi-box-seam"></i> StockFlow
        </a>

        <div>
            <a href="#planos" class="btn btn-outline-primary me-2">Planos</a>

            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                    Meu painel
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary me-2">
                    Entrar
                </a>

                <a href="{{ route('cadastro') }}" class="btn btn-primary">
                    Criar conta
                </a>
            @endauth
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">
            Controle seu estoque de forma simples e profissional
        </h1>

        <p class="lead mt-3">
            O StockFlow ajuda pequenos e médios comércios a controlar produtos,
            clientes, vendas, movimentações e faturamento em uma única plataforma.
        </p>

        <div class="mt-4">
            <a href="#planos" class="btn btn-light btn-lg">
                Ver planos
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-lg ms-2">
                    Ir para o painel
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg ms-2">
                    Já tenho conta
                </a>
            @endauth
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">O que o StockFlow oferece?</h2>
            <p class="text-muted">
                Tudo que sua empresa precisa para vender e controlar melhor.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm h-100 text-center p-3">
                    <i class="bi bi-box fs-1 text-primary"></i>
                    <h5 class="mt-3">Produtos</h5>
                    <p>Cadastre produtos, preços, SKU e estoque mínimo.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm h-100 text-center p-3">
                    <i class="bi bi-people fs-1 text-success"></i>
                    <h5 class="mt-3">Clientes</h5>
                    <p>Organize seus clientes e dados de contato.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm h-100 text-center p-3">
                    <i class="bi bi-cart-check fs-1 text-warning"></i>
                    <h5 class="mt-3">Vendas</h5>
                    <p>Registre vendas e reduza o estoque automaticamente.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm h-100 text-center p-3">
                    <i class="bi bi-graph-up fs-1 text-danger"></i>
                    <h5 class="mt-3">Dashboard</h5>
                    <p>Acompanhe faturamento, vendas e estoque baixo.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="planos" class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Escolha seu plano</h2>
            <p class="text-muted">
                Todos os planos possuem 7 dias grátis. Depois você poderá pagar por PIX ou cartão.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card plan-card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h4 class="fw-bold">Básico</h4>
                        <h2 class="text-primary">R$ 39</h2>
                        <p>/mês</p>

                        <hr>

                        <p>1 usuário</p>
                        <p>Até 500 produtos</p>
                        <p>Controle de estoque</p>

                        @auth
                            <a href="{{ route('checkout') }}?plano=basico" class="btn btn-outline-primary w-100">
                                Assinar plano
                            </a>
                        @else
                            <a href="{{ route('cadastro') }}?plano=basico" class="btn btn-outline-primary w-100">
                                Criar conta e assinar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card plan-card shadow h-100 border-primary">
                    <div class="card-body text-center">
                        <span class="badge bg-primary mb-2">Mais escolhido</span>

                        <h4 class="fw-bold">Pro</h4>
                        <h2 class="text-primary">R$ 79</h2>
                        <p>/mês</p>

                        <hr>

                        <p>Até 5 usuários</p>
                        <p>Produtos ilimitados</p>
                        <p>Dashboard avançado</p>
                        <p>Relatórios</p>

                        @auth
                            <a href="{{ route('checkout') }}?plano=pro" class="btn btn-primary w-100">
                                Assinar plano
                            </a>
                        @else
                            <a href="{{ route('cadastro') }}?plano=pro" class="btn btn-primary w-100">
                                Criar conta e assinar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card plan-card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h4 class="fw-bold">Premium</h4>
                        <h2 class="text-primary">R$ 149</h2>
                        <p>/mês</p>

                        <hr>

                        <p>Usuários ilimitados</p>
                        <p>Relatórios PDF</p>
                        <p>Dashboard Premium</p>
                        <p>Suporte prioritário</p>

                        @auth
                            <a href="{{ route('checkout') }}?plano=premium" class="btn btn-outline-primary w-100">
                                Assinar plano
                            </a>
                        @else
                            <a href="{{ route('cadastro') }}?plano=premium" class="btn btn-outline-primary w-100">
                                Criar conta e assinar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="py-4 text-center text-muted">
    <p class="mb-0">
        © {{ date('Y') }} StockFlow - Sistema SaaS de gestão de estoque
    </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>