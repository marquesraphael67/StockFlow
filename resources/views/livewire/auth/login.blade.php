<x-guest-layout>
    <div class="auth-card">
        <div class="auth-header">
            <i class="bi bi-box-seam"></i>
            <h3 class="fw-bold mt-2 mb-1">Entrar no StockFlow</h3>
            <p class="text-muted mb-0">Acesse sua empresa</p>
        </div>

        <div class="auth-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Lembrar de mim
                    </label>
                </div>

                <button class="btn btn-primary w-100 py-2 fw-semibold">
                    Entrar
                </button>
            </form>

            <div class="text-center mt-4">
                <span class="text-muted">Ainda não tem conta?</span>
                <a href="{{ route('cadastro') }}" class="fw-semibold text-decoration-none">
                    Criar conta
                </a>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('home') }}" class="text-muted text-decoration-none">
                    <i class="bi bi-arrow-left"></i> Voltar para o site
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>