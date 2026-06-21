<x-guest-layout>
    <div class="auth-card-new">
        <div class="auth-left">
            <a href="{{ route('home') }}" class="brand-auth">
                <i class="bi bi-box-seam"></i> StockFlow
            </a>

            <h2>Entrar</h2>
            <p class="text-muted mb-4">Acesse o painel da sua empresa.</p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label>E-mail</label>
                <input type="email" name="email" class="form-control mb-2" required autofocus>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror

                <label class="mt-3">Senha</label>
                <input type="password" name="password" class="form-control mb-2" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror

                <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
                    <label class="d-flex align-items-center gap-2 mb-0">
                        <input type="checkbox" name="remember">
                        <span class="text-muted">Lembrar de mim</span>
                    </label>

                    <a href="{{ route('password.request') }}" class="text-decoration-none fw-bold">
                        Esqueceu a senha?
                    </a>
                </div>

                <button class="btn btn-primary w-100 py-2">
                    Entrar no sistema
                </button>
            </form>

            <div class="text-center my-3 text-muted">ou</div>

            <button type="button" class="btn btn-outline-secondary w-100">
                <i class="bi bi-google me-2"></i>
                Continuar com Google
            </button>

            <div class="text-center mt-4">
                <span class="text-muted">Ainda não tem conta?</span>
                <a href="{{ route('cadastro') }}" class="fw-bold text-decoration-none">
                    Criar conta
                </a>
            </div>
        </div>

        <div class="auth-right">
            <div class="floating-card">
                <small class="text-primary fw-bold">ACESSO SEGURO</small>
                <h5 class="fw-bold mt-2">Painel empresarial</h5>
                <h2 class="fw-bold text-primary">Online</h2>

                <div class="progress mt-3" style="height: 9px;">
                    <div class="progress-bar" style="width: 88%"></div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <small class="text-muted">Segurança da conta</small>
                    <small class="fw-bold">88%</small>
                </div>
            </div>

            <h3>Gerencie sua empresa com segurança.</h3>

            <p>
                Acesse produtos, vendas, clientes, relatórios, usuários e configurações
                da sua empresa em um painel moderno.
            </p>

            <div class="preview-mini">
                <div class="d-flex justify-content-between mb-2">
                    <span>Login protegido</span>
                    <strong>Ativo</strong>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span>Multiempresa</span>
                    <strong>Sim</strong>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Permissões</span>
                    <strong>Admin/Funcionário</strong>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>