<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Produtos / Estoque</h1>
            <small class="text-muted">Controle produtos, preços e estoque.</small>
        </div>

        <button wire:click="$toggle('mostrarArquivados')" class="btn btn-outline-secondary">
            {{ $mostrarArquivados ? 'Ver ativos' : 'Ver arquivados' }}
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(!$mostrarArquivados)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">
                {{ $produto_id ? 'Editar produto' : 'Novo produto' }}
            </div>

            <div class="card-body">
                <form wire:submit.prevent="salvar">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" wire:model="nome">
                            @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Categoria</label>
                            <select class="form-select" wire:model="categoria_id">
                                <option value="">Sem categoria</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">SKU</label>
                            <input type="text" class="form-control" wire:model="sku">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Estoque</label>
                            <input type="number" class="form-control" wire:model="estoque">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Preço custo</label>
                            <input type="number" step="0.01" class="form-control" wire:model="preco_custo">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Preço venda</label>
                            <input type="number" step="0.01" class="form-control" wire:model="preco_venda">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Estoque mínimo</label>
                            <input type="number" class="form-control" wire:model="estoque_minimo">
                        </div>

                        <div class="col-md-3 d-flex align-items-end gap-2">
                            <button class="btn btn-primary w-100">
                                Salvar
                            </button>

                            @if($produto_id)
                                <button type="button" wire:click="limpar" class="btn btn-outline-secondary">
                                    Cancelar
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="row g-3 mb-3">
    <div class="col-md-8">
        <input
            type="text"
            class="form-control"
            placeholder="Buscar por nome ou SKU..."
            wire:model.live="busca">
    </div>

    <div class="col-md-4">
        <select class="form-select" wire:model.live="filtro_categoria">
            <option value="">Todas as categorias</option>

            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
    </div>
</div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            {{ $mostrarArquivados ? 'Produtos arquivados' : 'Produtos ativos' }}
        </div>

        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>SKU</th>
                        <th>Estoque</th>
                        <th>Preço venda</th>
                        <th width="180">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($produtos as $produto)
                        <tr>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->categoria->nome ?? '-' }}</td>
                            <td>{{ $produto->sku ?? '-' }}</td>
                            <td>
                                {{ $produto->estoque }}

                                @if($produto->estoque <= $produto->estoque_minimo)
                                    <span class="badge bg-danger">baixo</span>
                                @endif
                            </td>
                            <td>R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                            <td>
                                @if($mostrarArquivados)
                                    <button wire:click="restaurar({{ $produto->id }})" class="btn btn-sm btn-success">
                                        Restaurar
                                    </button>
                                @else
                                    <button wire:click="editar({{ $produto->id }})" class="btn btn-sm btn-warning">
                                        Editar
                                    </button>

                                    <button wire:click="arquivar({{ $produto->id }})" class="btn btn-sm btn-danger">
                                        Arquivar
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Nenhum produto encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>