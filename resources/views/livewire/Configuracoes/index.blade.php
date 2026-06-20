<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Configurações</h1>
            <small class="text-muted">Gerencie sua empresa, perfil e segurança da conta.</small>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="alert alert-primary border-0 shadow-sm mb-4">
        <div class="d-flex align-items-center">
            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3"
                 style="width:55px;height:55px;">
                <i class="bi bi-building fs-3 text-primary"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-0">{{ $empresa_nome }}</h5>
                <small>
                    Plano {{ ucfirst(auth()->user()->empresa->plano) }}
                    • Status {{ ucfirst(auth()->user()->empresa->status) }}
                </small>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
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

                            <div class="col-md-6">
                                <label class="form-label">Telefone</label>
                                <input type="text"
                                       class="form-control form-control-lg"
                                       wire:model.live="telefone"
                                       maxlength="15"
                                       oninput="formatarTelefone(this)">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">CPF/CNPJ</label>
                                <input type="text"
                                       class="form-control form-control-lg"
                                       wire:model.live="cpf_cnpj"
                                       maxlength="18"
                                       oninput="formatarCpfCnpj(this)">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">CEP</label>
                                <input type="text"
                                       class="form-control form-control-lg"
                                       wire:model.live="cep"
                                       maxlength="9"
                                       oninput="formatarCep(this)"
                                       onblur="buscarCep(this.value)">
                            </div>

                            <div class="col-md-8">
                                <label class="form-label">Endereço</label>
                                <input type="text" class="form-control form-control-lg" wire:model="endereco">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Número</label>
                                <input type="text" class="form-control form-control-lg" wire:model="numero">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Bairro</label>
                                <input type="text" class="form-control form-control-lg" wire:model="bairro">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Cidade</label>
                                <input type="text" class="form-control form-control-lg" wire:model="cidade">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">UF</label>
                                <input type="text" class="form-control form-control-lg" wire:model="estado" maxlength="2">
                            </div>

<div class="col-md-12">
    <label class="form-label">Logo da empresa</label>
    <input type="file" class="form-control form-control-lg" wire:model="logo">

    @if(auth()->user()->empresa->logo)
        <div class="mt-3">
            <img src="{{ asset('storage/' . auth()->user()->empresa->logo) }}"
                 style="max-height: 80px;"
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
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-person-circle me-2 text-success"></i>
                        Meu Perfil
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form wire:submit.prevent="salvarPerfil">
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control form-control-lg" wire:model="user_name">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control form-control-lg" wire:model="user_email">
                        </div>

                        <button class="btn btn-success w-100 py-2">
                            <i class="bi bi-person-check me-2"></i>
                            Atualizar perfil
                        </button>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning py-3">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-shield-lock me-2"></i>
                        Segurança
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form wire:submit.prevent="alterarSenha">
                        <div class="mb-3">
                            <label class="form-label">Nova senha</label>
                            <input type="password" class="form-control form-control-lg" wire:model="password">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirmar senha</label>
                            <input type="password" class="form-control form-control-lg" wire:model="password_confirmation">
                        </div>

                        <button class="btn btn-warning w-100 py-2">
                            <i class="bi bi-key me-2"></i>
                            Alterar senha
                        </button>
                    </form>
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