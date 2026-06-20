<div>
    <div class="mb-4">
        <h1 class="fw-bold mb-0">Vendas</h1>
        <small class="text-muted">Registre vendas e baixe o estoque automaticamente.</small>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('erro'))
        <div class="alert alert-danger">{{ session('erro') }}</div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">
            Nova venda
        </div>

        <div class="card-body">
            <form wire:submit.prevent="finalizarVenda">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Cliente</label>
                        <select class="form-select" wire:model="cliente_id">
                            <option value="">Consumidor final</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
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
                        <label class="form-label">Quantidade</label>
                        <input type="number" min="1" class="form-control" wire:model="quantidade">
                        @error('quantidade') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100">
                            Finalizar
                        </button>
                    </div>
                </div>
            </form>
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
                        <th>Status</th>
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
                                        {{ $item->produto->nome ?? '-' }}
                                        x{{ $item->quantidade }}
                                    </div>
                                @endforeach
                            </td>
                            <td>R$ {{ number_format($venda->total, 2, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ ucfirst($venda->status) }}
                                </span>
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