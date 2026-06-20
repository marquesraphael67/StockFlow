<div class="auth-card">
    <div class="auth-header">
        <i class="bi bi-box-seam"></i>
        <h3 class="fw-bold mt-2 mb-1">Criar conta StockFlow</h3>
        <p class="text-muted mb-0">Comece seu teste grátis de 7 dias</p>
    </div>

    <div class="auth-body">
        <form wire:submit.prevent="cadastrar">
            <div class="mb-3">
                <label class="form-label">Nome da empresa</label>
                <input type="text" class="form-control" wire:model="empresa_nome">
                @error('empresa_nome') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nome do responsável</label>
                <input type="text" class="form-control" wire:model="responsavel_nome">
                @error('responsavel_nome') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control" wire:model="email">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Plano escolhido</label>
                <select class="form-select" wire:model="plano">
                    <option value="basico">Básico - R$ 39/mês</option>
                    <option value="pro">Pro - R$ 79/mês</option>
                    <option value="premium">Premium - R$ 149/mês</option>
                </select>
                @error('plano') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" class="form-control" wire:model="password">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Confirmar senha</label>
                    <input type="password" class="form-control" wire:model="password_confirmation">
                </div>
            </div>

            <button class="btn btn-primary w-100 py-2 fw-semibold">
                Criar conta e iniciar teste grátis
            </button>
        </form>

        <div class="text-center mt-4">
            <span class="text-muted">Já tem conta?</span>
            <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">
                Entrar
            </a>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="text-muted text-decoration-none">
                <i class="bi bi-arrow-left"></i> Voltar para o site
            </a>
        </div>
    </div>
</div>