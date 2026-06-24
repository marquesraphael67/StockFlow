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

        .danger-card{
            background:linear-gradient(135deg,#7f1d1d,#dc2626);
            color:white;
            border-radius:28px;
            box-shadow:0 22px 55px rgba(220,38,38,.25);
            overflow:hidden;
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

        .logo-preview{
            max-height:100px;
            border-radius:18px;
            border:1px solid #e2e8f0;
            padding:10px;
            background:white;
        }

        @media(max-width:768px){
            .premium-hero{padding:24px}
            .premium-card,.kpi-card,.danger-card{border-radius:22px}
        }

        body.dark-mode .premium-card,
        body.dark-mode .kpi-card{
            background:rgba(15,23,42,.88);
            border-color:rgba(51,65,85,.9);
            color:#e5e7eb;
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select{
            background:rgba(15,23,42,.9);
            color:#e5e7eb;
            border-color:#334155;
        }
    </style>

    @php
        $empresa = auth()->user()->empresa;
        $trialEnds = $empresa->trial_ends_at ?? null;
        $diasTrial = $trialEnds ? max(0, ceil(now()->diffInHours($trialEnds, false) / 24)) : 0;
    @endphp

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

    <div class="premium-hero mb-4 motion-div">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
            <div>
                <span class="premium-badge">
                    <i class="bi bi-gear"></i>
                    Administração da conta
                </span>

                <h1 class="fw-bold mt-3 mb-2">Configurações</h1>

                <p class="mb-0 opacity-75">
                    Gerencie empresa, perfil, segurança, assinatura e dados da conta.
                </p>
            </div>

            <a href="{{ route('assinatura.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold">
                <i class="bi bi-gem me-2"></i>
                Gerenciar assinatura
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4 motion-div">
        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Plano atual</p>
                        <h4 class="fw-bold mb-0">{{ ucfirst($empresa->plano ?? 'Básico') }}</h4>
                    </div>
                    <div class="icon-soft"><i class="bi bi-gem"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Status</p>
                        <h4 class="fw-bold mb-0">{{ ucfirst($empresa->status ?? 'ativo') }}</h4>
                    </div>
                    <div class="icon-soft"><i class="bi bi-check-circle"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Trial</p>
                        <h4 class="fw-bold mb-0">{{ ($empresa->status ?? '') === 'trial' ? $diasTrial . ' dias' : 'Finalizado' }}</h4>
                    </div>
                    <div class="icon-soft"><i class="bi bi-hourglass-split"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Empresa</p>
                        <h4 class="fw-bold mb-0">{{ $empresa->nome ?? 'StockFlow' }}</h4>
                    </div>
                    <div class="icon-soft"><i class="bi bi-building"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="premium-card p-4 mb-4 motion-div">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="icon-soft">
                <i class="bi bi-building"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-0">Dados da Empresa</h5>
                <small class="text-muted">Informações comerciais e endereço da empresa.</small>
            </div>
        </div>

        <form wire:submit.prevent="salvarEmpresa">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nome da empresa</label>
                    <input type="text" class="form-control form-control-lg" wire:model="empresa_nome">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">E-mail da empresa</label>
                    <input type="email" class="form-control form-control-lg" wire:model="empresa_email">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Telefone</label>
                    <input type="text" class="form-control form-control-lg" wire:model.live="telefone" maxlength="15" oninput="formatarTelefone(this)">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">CPF/CNPJ</label>
                    <input type="text" class="form-control form-control-lg" wire:model.live="cpf_cnpj" maxlength="18" oninput="formatarCpfCnpj(this)">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">CEP</label>
                    <input type="text" class="form-control form-control-lg" wire:model.live="cep" maxlength="9" oninput="formatarCep(this)" onblur="buscarCep(this.value)">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Endereço</label>
                    <input type="text" class="form-control form-control-lg" wire:model="endereco">
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold">Número</label>
                    <input type="text" class="form-control form-control-lg" wire:model="numero">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Bairro</label>
                    <input type="text" class="form-control form-control-lg" wire:model="bairro">
                </div>

                <div class="col-md-5">
                    <label class="form-label fw-semibold">Cidade</label>
                    <input type="text" class="form-control form-control-lg" wire:model="cidade">
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold">UF</label>
                    <input type="text" class="form-control form-control-lg" wire:model="estado" maxlength="2">
                </div>

                <div class="col-md-5">
                    <label class="form-label fw-semibold">Logo da empresa</label>
                    <input type="file" class="form-control form-control-lg" wire:model="logo">

                    @if($empresa->logo)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $empresa->logo) }}" class="logo-preview">
                        </div>
                    @endif

                    @error('logo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 mt-4">
                    <button class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                        <i class="bi bi-check-circle me-2"></i>
                        Salvar dados da empresa
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="premium-card p-4 mb-4 motion-div">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="icon-soft">
                <i class="bi bi-person-circle"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-0">Meu Perfil</h5>
                <small class="text-muted">Dados do usuário principal de acesso.</small>
            </div>
        </div>

        <form wire:submit.prevent="salvarPerfil">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nome</label>
                    <input type="text" class="form-control form-control-lg" wire:model="user_name">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">E-mail de acesso</label>
                    <input type="email" class="form-control form-control-lg" wire:model="user_email">
                    @error('user_email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Senha atual para trocar e-mail</label>
                    <input type="password" class="form-control form-control-lg" wire:model="current_password_email" placeholder="Obrigatório se trocar e-mail">
                    @error('current_password_email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-12 mt-4">
                    <button class="btn btn-success rounded-pill px-4 py-2 fw-semibold">
                        <i class="bi bi-person-check me-2"></i>
                        Atualizar perfil
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="premium-card p-4 mb-4 motion-div">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="icon-soft">
                <i class="bi bi-shield-lock"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-0">Segurança e Senha</h5>
                <small class="text-muted">Atualize sua senha de acesso com segurança.</small>
            </div>
        </div>

        <form wire:submit.prevent="alterarSenha">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Senha atual</label>
                    <input type="password" class="form-control form-control-lg" wire:model="current_password">
                    @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nova senha</label>
                    <input type="password" class="form-control form-control-lg" wire:model="password">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Confirmar nova senha</label>
                    <input type="password" class="form-control form-control-lg" wire:model="password_confirmation">
                </div>

                <div class="col-12 mt-4">
                    <button class="btn btn-warning rounded-pill px-4 py-2 fw-semibold">
                        <i class="bi bi-key me-2"></i>
                        Alterar senha
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="premium-card p-4 mb-4 motion-div">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-soft">
                    <i class="bi bi-gem"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-0">Assinatura</h5>
                    <small class="text-muted">
                        Plano {{ ucfirst($empresa->plano ?? 'basico') }} • {{ ucfirst($empresa->status ?? 'ativo') }}
                    </small>
                </div>
            </div>

            <a href="{{ route('assinatura.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                Gerenciar plano
            </a>
        </div>
    </div>

    <div class="danger-card p-4 motion-div">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div style="width:50px;height:50px;border-radius:18px;display:grid;place-items:center;background:rgba(255,255,255,.18);font-size:1.5rem;">
                <i class="bi bi-exclamation-triangle"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-0">Zona de perigo</h5>
                <small class="opacity-75">Essa ação remove todos os dados da empresa.</small>
            </div>
        </div>

        <p class="opacity-75">
            Ao excluir sua conta, todos os dados da empresa serão apagados:
            produtos, clientes, vendas, movimentações, relatórios, usuários e configurações.
        </p>

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Digite EXCLUIR para confirmar</label>
                <input type="text" class="form-control form-control-lg" wire:model="delete_confirmation">
                @error('delete_confirmation') <small class="text-warning">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Senha atual</label>
                <input type="password" class="form-control form-control-lg" wire:model="delete_password">
                @error('delete_password') <small class="text-warning">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button
                    wire:click="excluirConta"
                    onclick="return confirm('Tem certeza? Essa ação não pode ser desfeita.')"
                    class="btn btn-light text-danger fw-bold w-100 py-3 rounded-pill">
                    <i class="bi bi-trash me-2"></i>
                    Excluir minha conta
                </button>
            </div>
        </div>
    </div>

    <script>
        function formatarTelefone(input) {
            let value = input.value.replace(/\D/g, '');

            if (value.length > 11) value = value.substring(0, 11);

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

            if (value.length > 8) value = value.substring(0, 8);

            value = value.replace(/^(\d{5})(\d)/, '$1-$2');

            input.value = value;
        }

        function buscarCep(cep) {
            cep = cep.replace(/\D/g, '');

            if (cep.length !== 8) return;

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

        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.getElementById('successToast');
            if (toastEl) new bootstrap.Toast(toastEl, { delay: 3500 }).show();
        });
    </script>
</div>