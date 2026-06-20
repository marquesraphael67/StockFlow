<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Categorias</h1>
            <small class="text-muted">
                Organize seus produtos por categorias.
            </small>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">
            Nova Categoria
        </div>

        <div class="card-body">
            <form wire:submit.prevent="salvar">
                <div class="row">
                    <div class="col-md-10">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Nome da categoria"
                            wire:model="nome">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">
                            Salvar
                        </button>
                    </div>
                </div>

                @error('nome')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            Categorias cadastradas
        </div>

        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Categoria</th>
                        <th>Criado em</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nome }}</td>
                            <td>{{ $categoria->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Nenhuma categoria cadastrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>