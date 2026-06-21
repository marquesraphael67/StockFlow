<x-guest-layout>
    <div class="auth-card-new">
        <div class="auth-left">
            <a href="{{ route('home') }}" class="brand-auth">
                <i class="bi bi-box-seam"></i> StockFlow
            </a>

            <h2>Recuperar senha</h2>
            <p class="text-muted mb-4">
                Informe seu e-mail para receber o link de redefinição.
            </p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
    @csrf

    <label>E-mail cadastrado</label>
    <input type="email" name="email" class="form-control mb-2" required autofocus>

    <button class="btn btn-primary w-100 py-2 mt-4">
        Enviar link de recuperação
    </button>
</form>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="fw-bold text-decoration-none">
                    Voltar para login
                </a>
            </div>
        </div>

        <div class="auth-right">
            <div class="floating-card">
                <small class="text-primary fw-bold">RECUPERAÇÃO</small>
                <h5 class="fw-bold mt-2">Redefina sua senha</h5>
                <h2 class="fw-bold text-primary">
                    <i class="bi bi-shield-lock"></i>
                </h2>
            </div>

            <h3>Recupere o acesso com segurança.</h3>

            <p>
                Enviaremos um link para o e-mail cadastrado na sua conta.
            </p>
        </div>
    </div>
</x-guest-layout>