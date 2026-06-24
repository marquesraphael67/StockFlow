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
        <div class="toast-container position-fixed top-0 end-0 p-4" style="z-index:9999">
            <div id="successToast" class="toast show border-0 shadow-lg">
                <div class="toast-header bg-success text-white">
                    <i class="bi bi-check-circle me-2"></i>
                    <strong class="me-auto">Sucesso</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    <div class="premium-hero mb-4 motion-div">
        <span class="premium-badge">
            <i class="bi bi-tags"></i>
            Organização de estoque
        </span>

        <h1 class="fw-bold mt-3 mb-2">Categorias</h1>
        <p class="mb-0 opacity-75">Organize seus produtos por grupos e facilite a gestão do estoque.</p>
    </div>

    <div class="premium-card p-4 mb-4 motion-div">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="icon-soft">
                <i class="bi bi-plus-circle"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0">Nova categoria</h5>
                <small class="text-muted">Cadastre uma nova categoria para seus produtos.</small>
            </div>
        </div>

        <form wire:submit.prevent="salvar">
            <div class="row g-3">
                <div class="col-md-10">
                    <input type="text" class="form-control form-control-lg rounded-4" placeholder="Nome da categoria" wire:model="nome">
                    @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary btn-lg w-100 rounded-pill">
                        <i class="bi bi-check-circle me-2"></i>
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="premium-card p-4 motion-div">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="icon-soft">
                <i class="bi bi-list-ul"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0">Categorias cadastradas</h5>
                <small class="text-muted">Todas as categorias da empresa.</small>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle premium-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Categoria</th>
                        <th>Criado em</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorias as $categoria)
                        <tr>
                            <td>#{{ $categoria->id }}</td>
                            <td><strong>{{ $categoria->nome }}</strong></td>
                            <td>{{ $categoria->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-5">
                                <i class="bi bi-tags fs-1 d-block mb-2"></i>
                                Nenhuma categoria cadastrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.getElementById('successToast');
            if (toastEl) new bootstrap.Toast(toastEl, { delay: 3500 }).show();
        });
    </script>
</div>