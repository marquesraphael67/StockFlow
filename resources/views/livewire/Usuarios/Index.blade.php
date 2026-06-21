<div>
    <div class="mb-4">
        <h1 class="fw-bold mb-0">Usuários da Empresa</h1>
        <small class="text-muted">Gerencie administradores e funcionários.</small>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('erro'))
        <div class="alert alert-danger">{{ session('erro') }}</div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">
            Novo usuário
        </div>

        <div class="card-body">
            <form wire:submit.prevent="salvar">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" wire:model="name">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" class="form-control" wire:model="email">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Senha</label>
                        <input type="password" class="form-control" wire:model="password">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" wire:model="tipo">
                            <option value="funcionario">Funcionário</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100">
                            Criar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            Usuários cadastrados
        </div>

        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Tipo</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                @if($usuario->tipo === 'admin')
                                    <span class="badge bg-primary">Admin</span>
                                @else
                                    <span class="badge bg-secondary">Funcionário</span>
                                @endif
                            </td>
                            <td>
                                @if($usuario->id !== auth()->id())
                                    <button wire:click="arquivar({{ $usuario->id }})"
                                            class="btn btn-sm btn-danger">
                                        Remover
                                    </button>
                                @else
                                    <span class="text-muted">Você</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>