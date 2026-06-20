<nav class="navbar navbar-expand-lg bg-white border-bottom px-4">
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
        StockFlow
    </a>

    <div class="ms-auto d-flex align-items-center gap-3">
        <span class="text-muted">
            {{ auth()->user()->name }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-danger btn-sm">
                Sair
            </button>
        </form>
    </div>
</nav>