<x-app-layout>
    @php
        $plano = request('plano', auth()->user()->empresa->plano ?? 'basico');

        $planos = [
            'basico' => [
                'nome' => 'Básico',
                'valor' => 39,
                'descricao' => '1 usuário, até 500 produtos e controle de estoque.'
            ],
            'pro' => [
                'nome' => 'Pro',
                'valor' => 79,
                'descricao' => 'Até 5 usuários, produtos ilimitados, dashboard avançado e relatórios.'
            ],
            'premium' => [
                'nome' => 'Premium',
                'valor' => 149,
                'descricao' => 'Usuários ilimitados, relatórios PDF, dashboard premium e suporte prioritário.'
            ],
        ];

        $planoAtual = $planos[$plano] ?? $planos['basico'];
    @endphp

    <div class="row justify-content-center">
        <div class="col-lg-10">

            @if(session('erro'))
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('erro') }}
                </div>
            @endif

            <div class="mb-4">
                <h1 class="fw-bold mb-1">Finalizar assinatura</h1>
                <p class="text-muted mb-0">Escolha a forma de pagamento e ative seu plano.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-credit-card text-primary me-2"></i>
                                Forma de pagamento
                            </h5>

                            <div class="border rounded-4 p-3 mb-3 payment-option" onclick="selecionarPagamento('pix')">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="forma_pagamento" id="pix" checked>
                                    <label class="form-check-label fw-semibold" for="pix">PIX</label>
                                </div>
                                <small class="text-muted">Aprovação rápida após confirmação do pagamento.</small>
                            </div>

                            <div class="border rounded-4 p-3 mb-3 payment-option" onclick="selecionarPagamento('cartao')">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="forma_pagamento" id="cartao">
                                    <label class="form-check-label fw-semibold" for="cartao">Cartão de crédito</label>
                                </div>
                                <small class="text-muted">Pagamento com cartão dentro do StockFlow.</small>
                            </div>

                            <div id="areaPix">
                                <form method="POST" action="{{ route('checkout.pix.gerar') }}">
                                    @csrf
                                    <input type="hidden" name="plano" value="{{ $plano }}">

                                    <button class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-qr-code me-2"></i>
                                        Gerar PIX
                                    </button>
                                </form>
                            </div>

                            <div id="areaCartao" style="display:none;">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Número do cartão</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="0000 0000 0000 0000">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Validade</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="MM/AA">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">CVV</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="123">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Nome impresso no cartão</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="Nome completo">
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-lg w-100 mt-4" disabled>
                                    <i class="bi bi-lock-fill me-2"></i>
                                    Pagar com cartão em breve
                                </button>

                                <div class="alert alert-info border-0 mt-3 mb-0">
                                    A opção de cartão será integrada com Mercado Pago na próxima etapa.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Resumo do plano</h5>

                            <h4 class="fw-bold">{{ $planoAtual['nome'] }}</h4>
                            <p class="text-muted">{{ $planoAtual['descricao'] }}</p>

                            <hr>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Plano</span>
                                <strong>{{ $planoAtual['nome'] }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Valor mensal</span>
                                <strong>R$ {{ number_format($planoAtual['valor'], 2, ',', '.') }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Teste grátis</span>
                                <strong>7 dias</strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between fs-4">
                                <span>Total hoje</span>
                                <strong>R$ 0,00</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h6 class="fw-bold">Empresa</h6>
                            <p class="mb-1">{{ auth()->user()->empresa->nome }}</p>
                            <small class="text-muted">{{ auth()->user()->empresa->email }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selecionarPagamento(tipo) {
            document.getElementById('pix').checked = tipo === 'pix';
            document.getElementById('cartao').checked = tipo === 'cartao';

            document.getElementById('areaPix').style.display = tipo === 'pix' ? 'block' : 'none';
            document.getElementById('areaCartao').style.display = tipo === 'cartao' ? 'block' : 'none';
        }
    </script>
</x-app-layout>