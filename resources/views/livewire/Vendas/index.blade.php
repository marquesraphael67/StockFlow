<div>
    <style>
        .motion-div { animation: fadeUp .45s ease both; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .premium-hero {
            background: linear-gradient(135deg, #0f172a, #2563eb);
            color: white;
            border-radius: 30px;
            padding: 32px;
            box-shadow: 0 24px 60px rgba(37,99,235,.28);
        }

        .premium-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,.16);
            color: white;
            font-size: .82rem;
            font-weight: 700;
            backdrop-filter: blur(14px);
        }

        .premium-card,
        .kpi-card {
            background: rgba(255,255,255,.88);
            border: 1px solid rgba(226,232,240,.9);
            border-radius: 28px;
            box-shadow: 0 18px 45px rgba(15,23,42,.08);
            backdrop-filter: blur(18px);
            transition: .25s ease;
        }

        .premium-card:hover,
        .kpi-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 24px 60px rgba(15,23,42,.12);
        }

        .kpi-card {
            padding: 22px;
            height: 100%;
        }

        .icon-soft {
            width: 50px;
            height: 50px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: #eff6ff;
            color: #2563eb;
            font-size: 1.5rem;
        }

        .premium-table thead th {
            color: #64748b;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            border-bottom: 1px solid #e2e8f0;
        }

        .premium-table tbody td {
            padding: 18px 10px;
            vertical-align: middle;
        }

        .premium-table tbody tr {
            transition: .2s ease;
        }

        .premium-table tbody tr:hover {
            background: rgba(37,99,235,.045);
            transform: scale(1.004);
        }

        .cart-total-box {
            background: linear-gradient(135deg, #0f172a, #2563eb);
            color: white;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 18px 40px rgba(37,99,235,.18);
        }

        .empty-state {
            padding: 52px 20px;
            text-align: center;
            color: #64748b;
        }

        .empty-state i {
            font-size: 3rem;
            display: block;
            margin-bottom: 12px;
        }

        .premium-modal {
            border: 0;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(15,23,42,.25);
        }

        .premium-modal-header {
            background: linear-gradient(135deg, #0f172a, #2563eb);
            color: white;
            border: 0;
            padding: 26px;
        }

        .form-control,
        .form-select {
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 12px 14px;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 .22rem rgba(37,99,235,.15);
            border-color: #2563eb;
        }

        .item-line {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #475569;
            font-size: .88rem;
            margin-bottom: 4px;
        }

        .cart-product {
            font-weight: 700;
            color: #0f172a;
        }

        @media (max-width: 768px) {
            .premium-hero { padding: 24px; }
            .premium-card, .kpi-card { border-radius: 22px; }
            .hero-action, .hero-action .btn { width: 100%; }
        }

        body.dark-mode .premium-card,
        body.dark-mode .kpi-card {
            background: rgba(15,23,42,.88);
            border-color: rgba(51,65,85,.9);
            color: #e5e7eb;
        }

        body.dark-mode .premium-table {
            color: #e5e7eb;
        }

        body.dark-mode .cart-product {
            color: #e5e7eb;
        }

        body.dark-mode .item-line {
            color: #cbd5e1;
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: rgba(15,23,42,.9);
            color: #e5e7eb;
            border-color: #334155;
        }
    </style>

    @if(session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-4" style="z-index: 9999;">
            <div id="successToast" class="toast show border-0 shadow-lg" role="alert">
                <div class="toast-header bg-success text-white">
                    <i class="bi bi-check-circle me-2"></i>
                    <strong class="me-auto">Sucesso</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('erro'))
        <div class="toast-container position-fixed top-0 end-0 p-4" style="z-index: 9999;">
            <div id="erroToast" class="toast show border-0 shadow-lg" role="alert">
                <div class="toast-header bg-danger text-white">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong class="me-auto">Erro</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('erro') }}
                </div>
            </div>
        </div>
    @endif

    <div class="premium-hero mb-4 motion-div">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
            <div>
                <span class="premium-badge">
                    <i class="bi bi-cart-check"></i>
                    Frente de vendas
                </span>

                <h1 class="fw-bold mt-3 mb-2">Vendas</h1>

                <p class="mb-0 opacity-75">
                    Venda com múltiplos produtos, desconto, lucro automático e baixa no estoque.
                </p>
            </div>

            <div class="hero-action">
                <button class="btn btn-light rounded-pill px-4 fw-semibold" data-bs-toggle="modal" data-bs-target="#vendaModal">
                    <i class="bi bi-cart-plus me-2"></i>
                    Nova venda
                </button>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4 motion-div">
        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Vendas registradas</p>
                        <h3 class="fw-bold mb-0">{{ $vendas->count() }}</h3>
                    </div>
                    <div class="icon-soft">
                        <i class="bi bi-bag-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Produtos no carrinho</p>
                        <h3 class="fw-bold mb-0">{{ count($carrinho) }}</h3>
                    </div>
                    <div class="icon-soft">
                        <i class="bi bi-cart3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total carrinho</p>
                        <h3 class="fw-bold mb-0">R$ {{ number_format($this->total, 2, ',', '.') }}</h3>
                    </div>
                    <div class="icon-soft">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Lucro estimado</p>
                        <h3 class="fw-bold text-success mb-0">R$ {{ number_format($this->lucroTotal, 2, ',', '.') }}</h3>
                    </div>
                    <div class="icon-soft">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="premium-card motion-div">
                <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-soft">
                            <i class="bi bi-clock-history"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-0">Histórico de vendas</h5>
                            <small class="text-muted">Vendas registradas recentemente.</small>
                        </div>
                    </div>
                </div>

                <div class="px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table align-middle premium-table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Cliente</th>
                                    <th>Itens</th>
                                    <th>Total</th>
                                    <th>Lucro</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($vendas as $venda)
                                    <tr class="motion-div">
                                        <td>
                                            <strong>{{ $venda->created_at->format('d/m/Y') }}</strong>
                                            <div class="text-muted small">{{ $venda->created_at->format('H:i') }}</div>
                                        </td>

                                        <td>
                                            <strong>{{ $venda->cliente->nome ?? 'Consumidor final' }}</strong>
                                        </td>

                                        <td>
                                            @foreach($venda->itens as $item)
                                                <div class="item-line">
                                                    <i class="bi bi-box-seam text-primary"></i>
                                                    {{ $item->produto->nome ?? '-' }} x{{ $item->quantidade }}
                                                </div>
                                            @endforeach
                                        </td>

                                        <td>
                                            <strong class="text-primary">
                                                R$ {{ number_format($venda->total, 2, ',', '.') }}
                                            </strong>
                                        </td>

                                        <td class="text-success fw-bold">
                                            R$ {{ number_format($venda->lucro_total, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="empty-state">
                                                <i class="bi bi-cart"></i>
                                                Nenhuma venda registrada.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="premium-card motion-div">
                <div class="p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-soft">
                            <i class="bi bi-cart-check"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-0">Carrinho atual</h5>
                            <small class="text-muted">Resumo da venda em aberto.</small>
                        </div>
                    </div>

                    @if(count($carrinho) > 0)
                        <div class="table-responsive">
                            <table class="table align-middle premium-table">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Qtd</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($carrinho as $index => $item)
                                        <tr>
                                            <td>
                                                <span class="cart-product">{{ $item['nome'] }}</span>
                                            </td>
                                            <td>{{ $item['quantidade'] }}</td>
                                            <td>R$ {{ number_format($item['subtotal'], 2, ',', '.') }}</td>
                                            <td>
                                                <button type="button"
                                                        wire:click="removerProduto({{ $index }})"
                                                        class="btn btn-sm btn-outline-danger rounded-pill">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Desconto</label>
                            <input type="number" step="0.01" min="0" class="form-control" wire:model.live="desconto">
                        </div>

                        <div class="cart-total-box">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <strong>R$ {{ number_format($this->subtotal, 2, ',', '.') }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Desconto</span>
                                <strong>R$ {{ number_format($desconto, 2, ',', '.') }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Lucro</span>
                                <strong>R$ {{ number_format($this->lucroTotal, 2, ',', '.') }}</strong>
                            </div>

                            <hr style="border-color: rgba(255,255,255,.3);">

                            <div class="d-flex justify-content-between fs-4">
                                <span>Total</span>
                                <strong>R$ {{ number_format($this->total, 2, ',', '.') }}</strong>
                            </div>
                        </div>

                        <button wire:click="finalizarVenda" class="btn btn-success w-100 mt-4 py-3 rounded-pill fw-semibold">
                            <i class="bi bi-check-circle me-2"></i>
                            Finalizar venda
                        </button>
                    @else
                        <div class="empty-state">
                            <i class="bi bi-cart"></i>
                            <p class="mt-3 mb-0">Nenhum produto no carrinho.</p>

                            <button class="btn btn-primary rounded-pill px-4 mt-3" data-bs-toggle="modal" data-bs-target="#vendaModal">
                                Adicionar produto
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="vendaModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content premium-modal">
                <div class="modal-header premium-modal-header">
                    <div>
                        <h5 class="modal-title fw-bold">Nova venda</h5>
                        <small class="opacity-75">Selecione cliente, produto e quantidade.</small>
                    </div>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Cliente</label>
                        <select class="form-select form-select-lg" wire:model="cliente_id">
                            <option value="">Consumidor final</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3 align-items-end">
                        <div class="col-md-7">
                            <label class="form-label fw-semibold">Produto</label>
                            <select class="form-select form-select-lg" wire:model="produto_id">
                                <option value="">Selecione</option>
                                @foreach($produtos as $produto)
                                    <option value="{{ $produto->id }}">
                                        {{ $produto->nome }} — Estoque: {{ $produto->estoque }} — R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('produto_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Qtd</label>
                            <input type="number" min="1" class="form-control form-control-lg" wire:model="quantidade">
                            @error('quantidade') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <button type="button" wire:click="adicionarProduto" class="btn btn-primary btn-lg w-100 rounded-pill">
                                <i class="bi bi-plus-circle me-2"></i>
                                Adicionar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successToast = document.getElementById('successToast');
            const erroToast = document.getElementById('erroToast');

            if (successToast) {
                new bootstrap.Toast(successToast, { delay: 3500 }).show();
            }

            if (erroToast) {
                new bootstrap.Toast(erroToast, { delay: 4500 }).show();
            }
        });
    </script>
</div>