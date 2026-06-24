<div>
    <style>
        .motion-div{animation:fadeUp .45s ease both}
        @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
        .premium-hero{background:linear-gradient(135deg,#0f172a,#2563eb);color:#fff;border-radius:30px;padding:32px;box-shadow:0 24px 60px rgba(37,99,235,.28)}
        .premium-badge{display:inline-flex;gap:8px;align-items:center;padding:8px 14px;border-radius:999px;background:rgba(255,255,255,.16);font-size:.82rem;font-weight:700}
        .premium-card{background:rgba(255,255,255,.88);border:1px solid rgba(226,232,240,.9);border-radius:28px;box-shadow:0 18px 45px rgba(15,23,42,.08);backdrop-filter:blur(18px)}
        .icon-soft{width:50px;height:50px;border-radius:18px;display:grid;place-items:center;background:#eff6ff;color:#2563eb;font-size:1.5rem}
        .premium-table thead th{color:#64748b;font-size:.78rem;text-transform:uppercase;letter-spacing:.05em}
        .premium-table tbody td{padding:18px 10px}
        .premium-table tbody tr:hover{background:rgba(37,99,235,.045)}
        body.dark-mode .premium-card{background:rgba(15,23,42,.88);border-color:#334155;color:#e5e7eb}
    </style>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('erro'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4">
            {{ session('erro') }}
        </div>
    @endif

    <div class="premium-hero mb-4 motion-div">
        <span class="premium-badge">
            <i class="bi bi-arrow-left-right"></i>
            Controle de estoque
        </span>

        <h1 class="fw-bold mt-3 mb-2">Movimentações</h1>
        <p class="mb-0 opacity-75">Registre entradas, saídas, ajustes, perdas e compras de produtos.</p>
    </div>

    <div class="premium-card p-4 mb-4 motion-div">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="icon-soft">
                <i class="bi bi-plus-circle"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0">Nova movimentação</h5>
                <small class="text-muted">Atualize o estoque automaticamente.</small>
            </div>
        </div>

        <form wire:submit.prevent="salvar">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Produto</label>
                    <select class="form-select form-select-lg rounded-4" wire:model="produto_id">
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
                    <label class="form-label fw-semibold">Tipo</label>
                    <select class="form-select form-select-lg rounded-4" wire:model="tipo">
                        <option value="entrada">Entrada</option>
                        <option value="saida">Saída</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold">Quantidade</label>
                    <input type="number" min="1" class="form-control form-control-lg rounded-4" wire:model="quantidade">
                    @error('quantidade') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Motivo</label>
                    <input type="text" class="form-control form-control-lg rounded-4" wire:model="motivo" placeholder="Compra, ajuste, perda...">
                </div>

                <div class="col-md-12">
                    <button class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                        <i class="bi bi-check-circle me-2"></i>
                        Registrar movimentação
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="premium-card p-4 motion-div">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="icon-soft">
                <i class="bi bi-clock-history"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0">Histórico de movimentações</h5>
                <small class="text-muted">Entradas e saídas registradas.</small>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle premium-table">
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
                            <td><strong>{{ $mov->produto->nome ?? '-' }}</strong></td>
                            <td>
                                @if($mov->tipo === 'entrada')
                                    <span class="badge bg-success rounded-pill px-3">Entrada</span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3">Saída</span>
                                @endif
                            </td>
                            <td><strong>{{ $mov->quantidade }}</strong></td>
                            <td>{{ $mov->motivo ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-arrow-left-right fs-1 d-block mb-2"></i>
                                Nenhuma movimentação registrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>