<div>
    <div class="mb-4">
        <h1 class="fw-bold mb-0">Configurações</h1>
        <small class="text-muted">Gerencie empresa, perfil, segurança e conta.</small>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- EMPRESA --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-building me-2 text-primary"></i>
                Dados da Empresa
            </h5>
        </div>

        <div class="card-body p-4">
            <form wire:submit.prevent="salvarEmpresa">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nome da empresa</label>
                        <input type="text" class="form-control form-control-lg" wire:model="empresa_nome">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">E-mail da empresa</label>
                        <input type="email" class="form-control form-control-lg" wire:model="empresa_email">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control form-control-lg" wire:model.live="telefone" maxlength="15" oninput="formatarTelefone(this)">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">CPF/CNPJ</label>
                        <input type="text" class="form-control form-control-lg" wire:model.live="cpf_cnpj" maxlength="18" oninput="formatarCpfCnpj(this)">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">CEP</label>
                        <input type="text" class="form-control form-control-lg" wire:model.live="cep" maxlength="9" oninput="formatarCep(this)" onblur="buscarCep(this.value)">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Endereço</label>
                        <input type="text" class="form-control form-control-lg" wire:model="endereco">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Número</label>
                        <input type="text" class="form-control form-control-lg" wire:model="numero">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Bairro</label>
                        <input type="text" class="form-control form-control-lg" wire:model="bairro">
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Cidade</label>
                        <input type="text" class="form-control form-control-lg" wire:model="cidade">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">UF</label>
                        <input type="text" class="form-control form-control-lg" wire:model="estado" maxlength="2">
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Logo da empresa</label>
                        <input type="file" class="form-control form-control-lg" wire:model="logo">

                        @if(auth()->user()->empresa->logo)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . auth()->user()->empresa->logo) }}"
                                     style="max-height: 90px;"
                                     class="rounded border p-2 bg-white">
                            </div>
                        @endif

                        @error('logo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 mt-4">
                        <button class="btn btn-primary px-4 py-2">
                            <i class="bi bi-check-circle me-2"></i>
                            Salvar dados da empresa
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- PERFIL --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-person-circle me-2 text-success"></i>
                Meu Perfil
            </h5>
        </div>

        <div class="card-body p-4">
            <form wire:submit.prevent="salvarPerfil">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control form-control-lg" wire:model="user_name">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">E-mail de acesso</label>
                        <input type="email" class="form-control form-control-lg" wire:model="user_email">
                        @error('user_email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Senha atual para trocar e-mail</label>
                        <input type="password" class="form-control form-control-lg" wire:model="current_password_email" placeholder="Obrigatório se trocar e-mail">
                        @error('current_password_email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-12 mt-4">
                        <button class="btn btn-success px-4 py-2">
                            <i class="bi bi-person-check me-2"></i>
                            Atualizar perfil
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- SEGURANÇA --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-shield-lock me-2 text-warning"></i>
                Segurança e Senha
            </h5>
        </div>

        <div class="card-body p-4">
            <form wire:submit.prevent="alterarSenha">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Senha atual</label>
                        <input type="password" class="form-control form-control-lg" wire:model="current_password">
                        @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Nova senha</label>
                        <input type="password" class="form-control form-control-lg" wire:model="password">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Confirmar nova senha</label>
                        <input type="password" class="form-control form-control-lg" wire:model="password_confirmation">
                    </div>

                    <div class="col-12 mt-4">
                        <button class="btn btn-warning px-4 py-2">
                            <i class="bi bi-key me-2"></i>
                            Alterar senha
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ZONA DE PERIGO --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-danger text-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Zona de perigo
            </h5>
        </div>

        <div class="card-body p-4">
            <p class="text-muted">
                Ao excluir sua conta, todos os dados da empresa serão apagados:
                produtos, clientes, vendas, movimentações, relatórios, usuários e configurações.
            </p>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Digite EXCLUIR para confirmar</label>
                    <input type="text" class="form-control form-control-lg" wire:model="delete_confirmation">
                    @error('delete_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Senha atual</label>
                    <input type="password" class="form-control form-control-lg" wire:model="delete_password">
                    @error('delete_password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button
                        wire:click="excluirConta"
                        onclick="return confirm('Tem certeza? Essa ação não pode ser desfeita.')"
                        class="btn btn-danger w-100 py-2">
                        <i class="bi bi-trash me-2"></i>
                        Excluir minha conta
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatarTelefone(input) {
            let value = input.value.replace(/\D/g, '');

            if (value.length > 11) {
                value = value.substring(0, 11);
            }

            value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
            value = value.replace(/(\d)(\d{4})$/, '$1-$2');

            input.value = value;
        }

        function formatarCpfCnpj(input) {
            let value = input.value.replace(/\D/g, '');

            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            } else {
                value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            }

            input.value = value;
        }

        function formatarCep(input) {
            let value = input.value.replace(/\D/g, '');

            if (value.length > 8) {
                value = value.substring(0, 8);
            }

            value = value.replace(/^(\d{5})(\d)/, '$1-$2');

            input.value = value;
        }

        function buscarCep(cep) {
            cep = cep.replace(/\D/g, '');

            if (cep.length !== 8) {
                return;
            }

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        alert('CEP não encontrado.');
                        return;
                    }

                    @this.set('endereco', data.logradouro);
                    @this.set('bairro', data.bairro);
                    @this.set('cidade', data.localidade);
                    @this.set('estado', data.uf);
                })
                .catch(() => {
                    alert('Erro ao buscar o CEP.');
                });
        }
    </script>
</div>