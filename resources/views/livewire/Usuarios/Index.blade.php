<div>
    <style>
        .motion-div{animation:fadeUp .45s ease both}
        @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}

        .premium-hero{
            background:linear-gradient(135deg,#0f172a,#2563eb);
            color:white;
            border-radius:30px;
            padding:32px;
            box-shadow:0 24px 60px rgba(37,99,235,.28);
        }

        .premium-badge{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:8px 14px;
            border-radius:999px;
            background:rgba(255,255,255,.16);
            color:white;
            font-size:.82rem;
            font-weight:700;
            backdrop-filter:blur(14px);
        }

        .premium-card,.kpi-card{
            background:rgba(255,255,255,.88);
            border:1px solid rgba(226,232,240,.9);
            border-radius:28px;
            box-shadow:0 18px 45px rgba(15,23,42,.08);
            backdrop-filter:blur(18px);
            transition:.25s ease;
        }

        .premium-card:hover,.kpi-card:hover{
            transform:translateY(-3px);
            box-shadow:0 24px 60px rgba(15,23,42,.12);
        }

        .kpi-card{
            padding:22px;
            height:100%;
        }

        .icon-soft{
            width:50px;
            height:50px;
            border-radius:18px;
            display:grid;
            place-items:center;
            background:#eff6ff;
            color:#2563eb;
            font-size:1.5rem;
        }

        .premium-table thead th{
            color:#64748b;
            font-size:.78rem;
            text-transform:uppercase;
            letter-spacing:.05em;
            border-bottom:1px solid #e2e8f0;
        }

        .premium-table tbody td{
            padding:18px 10px;
            vertical-align:middle;
        }

        .premium-table tbody tr:hover{
            background:rgba(37,99,235,.045);
        }

        .user-avatar{
            width:44px;
            height:44px;
            border-radius:16px;
            display:grid;
            place-items:center;
            background:#eff6ff;
            color:#2563eb;
            font-weight:800;
        }

        .role-admin{
            background:#dbeafe;
            color:#1d4ed8;
            padding:7px 12px;
            border-radius:999px;
            font-weight:700;
            font-size:.78rem;
        }

        .role-funcionario{
            background:#f1f5f9;
            color:#475569;
            padding:7px 12px;
            border-radius:999px;
            font-weight:700;
            font-size:.78rem;
        }

        .form-control,.form-select{
            border-radius:16px;
            border:1px solid #e2e8f0;
            padding:12px 14px;
        }

        .form-control:focus,.form-select:focus{
            box-shadow:0 0 0 .22rem rgba(37,99,235,.15);
            border-color:#2563eb;
        }

        @media(max-width:768px){
            .premium-hero{padding:24px}
            .premium-card,.kpi-card{border-radius:22px}
        }

        body.dark-mode .premium-card,
        body.dark-mode .kpi-card{
            background:rgba(15,23,42,.88);
            border-color:rgba(51,65,85,.9);
            color:#e5e7eb;
        }

        body.dark-mode .premium-table{
            color:#e5e7eb;
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select{
            background:rgba(15,23,42,.9);
            color:#e5e7eb;
            border-color:#334155;
        }

        body.dark-mode .role-funcionario{
            background:rgba(30,41,59,.9);
            color:#e5e7eb;
        }
    </style>

    @if(session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-4" style="z-index:9999;">
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

    @if(session('erro'))
        <div class="toast-container position-fixed top-0 end-0 p-4" style="z-index:9999;">
            <div id="erroToast" class="toast show border-0 shadow-lg">
                <div class="toast-header bg-danger text-white">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong class="me-auto">Erro</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">{{ session('erro') }}</div>
            </div>
        </div>
    @endif

    <div class="premium-hero mb-4 motion-div">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
            <div>
                <span class="premium-badge">
                    <i class="bi bi-people"></i>
                    Gestão de equipe
                </span>

                <h1 class="fw-bold mt-3 mb-2">Usuários da Empresa</h1>

                <p class="mb-0 opacity-75">
                    Gerencie administradores, funcionários e acessos da sua empresa.
                </p>
            </div>

            <div>
                <span class="premium-badge">
                    {{ $usuarios->count() }} usuário(s)
                </span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4 motion-div">
        <div class="col-md-4">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total de usuários</p>
                        <h3 class="fw-bold mb-0">{{ $usuarios->count() }}</h3>
                    </div>
                    <div class="icon-soft">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Administradores</p>
                        <h3 class="fw-bold mb-0">{{ $usuarios->where('tipo', 'admin')->count() }}</h3>
                    </div>
                    <div class="icon-soft">
                        <i class="bi bi-shield-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Funcionários</p>
                        <h3 class="fw-bold mb-0">{{ $usuarios->where('tipo', 'funcionario')->count() }}</h3>
                    </div>
                    <div class="icon-soft">
                        <i class="bi bi-person-badge"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="premium-card p-4 mb-4 motion-div">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="icon-soft">
                <i class="bi bi-person-plus"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-0">Novo usuário</h5>
                <small class="text-muted">Adicione um novo membro à empresa.</small>
            </div>
        </div>

        <form wire:submit.prevent="salvar">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Nome</label>
                    <input type="text" class="form-control form-control-lg" wire:model="name">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">E-mail</label>
                    <input type="email" class="form-control form-control-lg" wire:model="email">
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold">Senha</label>
                    <input type="password" class="form-control form-control-lg" wire:model="password">
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold">Tipo</label>
                    <select class="form-select form-select-lg" wire:model="tipo">
                        <option value="funcionario">Funcionário</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-primary w-100 rounded-pill py-3 fw-semibold">
                        <i class="bi bi-plus-circle me-2"></i>
                        Criar
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
                <h5 class="fw-bold mb-0">Usuários cadastrados</h5>
                <small class="text-muted">Lista de acessos vinculados à empresa.</small>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle premium-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>E-mail</th>
                        <th>Tipo</th>
                        <th width="140">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($usuarios as $usuario)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($usuario->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <strong>{{ $usuario->name }}</strong>

                                        @if($usuario->id === auth()->id())
                                            <div class="text-muted small">Você</div>
                                        @else
                                            <div class="text-muted small">Membro da empresa</div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td>{{ $usuario->email }}</td>

                            <td>
                                @if($usuario->tipo === 'admin')
                                    <span class="role-admin">
                                        <i class="bi bi-shield-check me-1"></i>
                                        Admin
                                    </span>
                                @else
                                    <span class="role-funcionario">
                                        <i class="bi bi-person-badge me-1"></i>
                                        Funcionário
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($usuario->id !== auth()->id())
                                    <button
                                        wire:click="arquivar({{ $usuario->id }})"
                                        onclick="return confirm('Deseja remover este usuário?')"
                                        class="btn btn-sm btn-danger rounded-pill px-3">
                                        <i class="bi bi-trash me-1"></i>
                                        Remover
                                    </button>
                                @else
                                    <span class="badge bg-light text-dark rounded-pill px-3">
                                        Você
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                <i class="bi bi-people fs-1 d-block mb-2"></i>
                                Nenhum usuário cadastrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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