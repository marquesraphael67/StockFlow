<div>
    <div class="mb-4">
        <h1 class="fw-bold mb-0">Vendas</h1>
        <small class="text-muted">Venda com múltiplos produtos, desconto e baixa automática no estoque.</small>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('erro'))
        <div class="alert alert-danger">{{ session('erro') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold">
                    Nova venda
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select class="form-select" wire:model="cliente_id">
                            <option value="">Consumidor final</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3 align-items-end">
                        <div class="col-md-7">
                            <label class="form-label">Produto</label>
                            <select class="form-select" wire:model="produto_id">
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
                            <label class="form-label">Qtd</label>
                            <input type="number" min="1" class="form-control" wire:model="quantidade">
                            @error('quantidade') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <button type="button" wire:click="adicionarProduto" class="btn btn-primary w-100">
                                <i class="bi bi-plus-circle"></i> Adicionar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">
                    Histórico de vendas
                </div>

                <div class="card-body">
                    <table class="table align-middle">
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
                                <tr>
                                    <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $venda->cliente->nome ?? 'Consumidor final' }}</td>
                                    <td>
                                        @foreach($venda->itens as $item)
                                            <div>
                                                {{ $item->produto->nome ?? '-' }} x{{ $item->quantidade }}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>R$ {{ number_format($venda->total, 2, ',', '.') }}</td>
                                    <td class="text-success fw-bold">
                                        R$ {{ number_format($venda->lucro_total, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        Nenhuma venda registrada.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">
                    Carrinho da venda
                </div>

                <div class="card-body">
                    @if(count($carrinho) > 0)
                        <table class="table align-middle">
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
                                        <td>{{ $item['nome'] }}</td>
                                        <td>{{ $item['quantidade'] }}</td>
                                        <td>R$ {{ number_format($item['subtotal'], 2, ',', '.') }}</td>
                                        <td>
                                            <button type="button"
                                                    wire:click="removerProduto({{ $index }})"
                                                    class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Desconto</label>
                            <input type="number" step="0.01" min="0" class="form-control" wire:model.live="desconto">
                        </div>

                        <div class="d-flex justify-content-between">
                            <span>Subtotal:</span>
                            <strong>R$ {{ number_format($this->subtotal, 2, ',', '.') }}</strong>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span>Desconto:</span>
                            <strong class="text-danger">R$ {{ number_format($desconto, 2, ',', '.') }}</strong>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span>Lucro estimado:</span>
                            <strong class="text-success">R$ {{ number_format($this->lucroTotal, 2, ',', '.') }}</strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fs-4">
                            <span>Total:</span>
                            <strong>R$ {{ number_format($this->total, 2, ',', '.') }}</strong>
                        </div>

                        <button wire:click="finalizarVenda" class="btn btn-success w-100 mt-4 py-2">
                            <i class="bi bi-check-circle"></i> Finalizar venda
                        </button>
                    @else
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-cart fs-1"></i>
                            <p class="mt-3 mb-0">Nenhum produto no carrinho.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>