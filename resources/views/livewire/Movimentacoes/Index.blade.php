<div>
    <div class="mb-4">
        <h1 class="fw-bold mb-0">Movimentações</h1>
        <small class="text-muted">Registre entradas e saídas de estoque.</small>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('erro'))
        <div class="alert alert-danger">{{ session('erro') }}</div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">
            Nova movimentação
        </div>

        <div class="card-body">
            <form wire:submit.prevent="salvar">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Produto</label>
                        <select class="form-select" wire:model="produto_id">
                            <option value="">Selecione</option>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}">
                                    {{ $produto->nome }} — Estoque: {{ $produto->estoque }}
                                </option>
                            @endforeach
                        </select>
                        @error('produto_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" wire:model="tipo">
                            <option value="entrada">Entrada</option>
                            <option value="saida">Saída</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Quantidade</label>
                        <input type="number" min="1" class="form-control" wire:model="quantidade">
                        @error('quantidade') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Motivo</label>
                        <input type="text" class="form-control" wire:model="motivo" placeholder="Compra, ajuste, perda...">
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary">
                            Registrar movimentação
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            Histórico de movimentações
        </div>

        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Produto</th>
                        <th>Tipo</th>
                        <th>Quantidade</th>
                        <th>Motivo</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($movimentacoes as $mov)
                        <tr>
                            <td>{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $mov->produto->nome ?? '-' }}</td>
                            <td>
                                @if($mov->tipo === 'entrada')
                                    <span class="badge bg-success">Entrada</span>
                                @else
                                    <span class="badge bg-danger">Saída</span>
                                @endif
                            </td>
                            <td>{{ $mov->quantidade }}</td>
                            <td>{{ $mov->motivo ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Nenhuma movimentação registrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>