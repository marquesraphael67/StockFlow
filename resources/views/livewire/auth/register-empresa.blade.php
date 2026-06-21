<div class="auth-card-new">
    <div class="auth-left">
        <a href="{{ route('home') }}" class="brand-auth">
            <i class="bi bi-box-seam"></i> StockFlow
        </a>

        <h2>Criar conta</h2>
        <p class="text-muted mb-4">
            Comece seu teste grátis de 7 dias.
        </p>

        <form wire:submit.prevent="cadastrar">
            <label>Nome da empresa</label>
            <input type="text" wire:model="empresa_nome" class="form-control mb-2">
            @error('empresa_nome') <small class="text-danger">{{ $message }}</small> @enderror

            <label class="mt-2">Nome do responsável</label>
            <input type="text" wire:model="responsavel_nome" class="form-control mb-2">
            @error('responsavel_nome') <small class="text-danger">{{ $message }}</small> @enderror

            <label class="mt-2">E-mail</label>
            <input type="email" wire:model="email" class="form-control mb-2">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror

            <label class="mt-2">Plano escolhido</label>
            <select wire:model="plano" class="form-select mb-2">
                <option value="basico">Básico - R$ 39/mês</option>
                <option value="pro">Pro - R$ 79/mês</option>
                <option value="premium">Premium - R$ 149/mês</option>
            </select>

            <div class="row">
                <div class="col-md-6">
                    <label class="mt-2">Senha</label>
                    <input type="password" wire:model="password" class="form-control mb-2">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="mt-2">Confirmar senha</label>
                    <input type="password" wire:model="password_confirmation" class="form-control mb-2">
                </div>
            </div>

            <button class="btn btn-primary w-100 py-2 mt-3">
                Criar conta e iniciar teste grátis
            </button>
        </form>

        <div class="text-center my-3 text-muted">ou</div>

        <button type="button" class="btn btn-outline-secondary w-100">
            <i class="bi bi-google me-2"></i>
            Continuar com Google
        </button>

        <div class="text-center mt-4">
            <span class="text-muted">Já tem conta?</span>
            <a href="{{ route('login') }}" class="fw-bold text-decoration-none">
                Entrar
            </a>
        </div>
    </div>

    <div class="auth-right">
        <div class="floating-card">
            <small class="text-primary fw-bold">
                DASHBOARD ONLINE
            </small>

            <h5 class="fw-bold mt-2">
                Faturamento do mês
            </h5>

            <h2 class="fw-bold text-primary">
                R$ 8.450,00
            </h2>

            <div class="progress mt-3" style="height: 9px;">
                <div class="progress-bar" style="width: 75%"></div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <small class="text-muted">Meta mensal</small>
                <small class="fw-bold">75%</small>
            </div>
        </div>

        <h3>Controle tudo em uma única plataforma.</h3>

        <p>
            Produtos, clientes, vendas, relatórios, lucro e estoque em tempo real.
            Tudo com visual moderno e feito para pequenos negócios.
        </p>

        <div class="preview-mini">
            <div class="d-flex justify-content-between mb-2">
                <span>Produtos ativos</span>
                <strong>320</strong>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <span>Clientes cadastrados</span>
                <strong>87</strong>
            </div>

            <div class="d-flex justify-content-between">
                <span>Lucro estimado</span>
                <strong>R$ 2.930,00</strong>
            </div>
        </div>
    </div>
</div>