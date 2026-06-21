<x-guest-layout>
    <div class="auth-card-new">
        <div class="auth-left">
            <a href="{{ route('home') }}" class="brand-auth">
                <i class="bi bi-box-seam"></i> StockFlow
            </a>

            <h2>Nova senha</h2>
            <p class="text-muted mb-4">
                Crie uma nova senha para acessar sua conta.
            </p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                <label>E-mail</label>
                <input type="email" name="email" value="{{ old('email', request('email')) }}" class="form-control mb-2" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror

                <label class="mt-3">Nova senha</label>
                <input type="password" name="password" class="form-control mb-2" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror

                <label class="mt-3">Confirmar senha</label>
                <input type="password" name="password_confirmation" class="form-control mb-4" required>

                <button class="btn btn-primary w-100 py-2">
                    Alterar senha
                </button>
            </form>
        </div>

        <div class="auth-right">
            <div class="floating-card">
                <small class="text-primary fw-bold">NOVA SENHA</small>
                <h5 class="fw-bold mt-2">Conta protegida</h5>
                <h2 class="fw-bold text-primary">
                    <i class="bi bi-key"></i>
                </h2>
            </div>

            <h3>Defina uma senha segura.</h3>

            <p>
                Use no mínimo 8 caracteres para proteger o acesso ao StockFlow.
            </p>
        </div>
    </div>
</x-guest-layout>