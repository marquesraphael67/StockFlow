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

        .premium-card {
            background: rgba(255,255,255,.88);
            border: 1px solid rgba(226,232,240,.9);
            border-radius: 28px;
            box-shadow: 0 18px 45px rgba(15,23,42,.08);
            backdrop-filter: blur(18px);
            transition: .25s ease;
        }

        .premium-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 24px 60px rgba(15,23,42,.12);
        }

        .search-card {
            padding: 22px;
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

        .stock-ok {
            background: #dcfce7;
            color: #166534;
            padding: 7px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: .78rem;
        }

        .stock-low {
            background: #fee2e2;
            color: #991b1b;
            padding: 7px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: .78rem;
        }

        .category-pill {
            background: #f1f5f9;
            color: #334155;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 700;
        }

        .price-text {
            color: #2563eb;
            font-weight: 800;
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

        @media (max-width: 768px) {
            .premium-hero { padding: 24px; }
            .premium-card { border-radius: 22px; }
            .hero-actions { width: 100%; }
            .hero-actions .btn { width: 100%; }
        }

        body.dark-mode .premium-card {
            background: rgba(15,23,42,.88);
            border-color: rgba(51,65,85,.9);
            color: #e5e7eb;
        }

        body.dark-mode .category-pill {
            background: rgba(30,41,59,.9);
            color: #e5e7eb;
        }

        body.dark-mode .premium-table {
            color: #e5e7eb;
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

    <div class="premium-hero mb-4 motion-div">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
            <div>
                <span class="premium-badge">
                    <i class="bi bi-box-seam"></i>
                    Gestão de estoque
                </span>

                <h1 class="fw-bold mt-3 mb-2">Produtos / Estoque</h1>

                <p class="mb-0 opacity-75">
                    Controle produtos, categorias, preços, estoque mínimo e arquivamentos.
                </p>
            </div>

            <div class="d-flex gap-2 flex-wrap hero-actions">
                <button wire:click="$toggle('mostrarArquivados')" class="btn btn-light rounded-pill px-4 fw-semibold">
                    <i class="bi {{ $mostrarArquivados ? 'bi-box-seam' : 'bi-archive' }} me-2"></i>
                    {{ $mostrarArquivados ? 'Ver ativos' : 'Ver arquivados' }}
                </button>

                @if(!$mostrarArquivados)
                    <button wire:click="limpar" class="btn btn-primary rounded-pill px-4 fw-semibold" data-bs-toggle="modal" data-bs-target="#produtoModal">
                        <i class="bi bi-plus-circle me-2"></i>
                        Novo produto
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="premium-card search-card mb-4 motion-div">
        <div class="row g-3 align-items-end">
            <div class="col-md-8">
                <label class="form-label fw-semibold">Buscar produto</label>
                <div class="input-group">
                    <span class="input-group-text border-0 bg-primary text-white rounded-start-4">
                        <i class="bi bi-search"></i>
                    </span>
                    <input
                        type="text"
                        class="form-control rounded-end-4"
                        placeholder="Buscar por nome ou SKU..."
                        wire:model.live="busca">
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Categoria</label>
                <select class="form-select" wire:model.live="filtro_categoria">
                    <option value="">Todas as categorias</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="premium-card motion-div">
        <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-soft">
                    <i class="bi bi-boxes"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-0">
                        {{ $mostrarArquivados ? 'Produtos arquivados' : 'Produtos ativos' }}
                    </h5>
                    <small class="text-muted">Lista completa de produtos cadastrados.</small>
                </div>
            </div>
        </div>

        <div class="px-4 pb-4">
            <div class="table-responsive">
                <table class="table align-middle premium-table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>SKU</th>
                            <th>Estoque</th>
                            <th>Preço venda</th>
                            <th width="190">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($produtos as $produto)
                            <tr class="motion-div">
                                <td>
                                    <strong>{{ $produto->nome }}</strong>
                                    <div class="text-muted small">
                                        Custo: R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}
                                    </div>
                                </td>

                                <td>
                                    <span class="category-pill">
                                        {{ $produto->categoria->nome ?? 'Sem categoria' }}
                                    </span>
                                </td>

                                <td>{{ $produto->sku ?? '-' }}</td>

                                <td>
                                    <strong>{{ $produto->estoque }}</strong>

                                    @if($produto->estoque <= $produto->estoque_minimo)
                                        <span class="stock-low ms-2">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            baixo
                                        </span>
                                    @else
                                        <span class="stock-ok ms-2">
                                            ok
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <span class="price-text">
                                        R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                                    </span>
                                </td>

                                <td>
                                    @if($mostrarArquivados)
                                        <button wire:click="restaurar({{ $produto->id }})" class="btn btn-sm btn-success rounded-pill px-3">
                                            <i class="bi bi-arrow-clockwise me-1"></i>
                                            Restaurar
                                        </button>
                                    @else
                                        <button
                                            wire:click="editar({{ $produto->id }})"
                                            class="btn btn-sm btn-warning rounded-pill"
                                            data-bs-toggle="modal"
                                            data-bs-target="#produtoModal">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button
                                            wire:click="arquivar({{ $produto->id }})"
                                            onclick="return confirm('Deseja arquivar este produto?')"
                                            class="btn btn-sm btn-danger rounded-pill">
                                            <i class="bi bi-archive"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-box"></i>
                                        Nenhum produto encontrado.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="produtoModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content premium-modal">
                <div class="modal-header premium-modal-header">
                    <div>
                        <h5 class="modal-title fw-bold">
                            {{ $produto_id ? 'Editar produto' : 'Novo produto' }}
                        </h5>
                        <small class="opacity-75">Preencha os dados do produto.</small>
                    </div>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit.prevent="salvar">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Nome</label>
                                <input type="text" class="form-control form-control-lg" wire:model="nome">
                                @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Categoria</label>
                                <select class="form-select form-select-lg" wire:model="categoria_id">
                                    <option value="">Sem categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label fw-semibold">SKU</label>
                                <input type="text" class="form-control form-control-lg" wire:model="sku">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Estoque</label>
                                <input type="number" class="form-control form-control-lg" wire:model="estoque">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Preço custo</label>
                                <input type="number" step="0.01" class="form-control form-control-lg" wire:model="preco_custo">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Preço venda</label>
                                <input type="number" step="0.01" class="form-control form-control-lg" wire:model="preco_venda">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Estoque mínimo</label>
                                <input type="number" class="form-control form-control-lg" wire:model="estoque_minimo">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 p-4">
                        @if($produto_id)
                            <button type="button" wire:click="limpar" class="btn btn-outline-secondary rounded-pill px-4">
                                Cancelar edição
                            </button>
                        @endif

                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                            Fechar
                        </button>

                        <button class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-check-circle me-2"></i>
                            Salvar produto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.getElementById('successToast');

            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3500
                });

                toast.show();
            }
        });
    </script>
</div>