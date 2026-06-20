<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Clientes</h1>
            <small class="text-muted">Cadastre e gerencie seus clientes.</small>
        </div>

        <button wire:click="$toggle('mostrarArquivados')" class="btn btn-outline-secondary">
            {{ $mostrarArquivados ? 'Ver ativos' : 'Ver arquivados' }}
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(!$mostrarArquivados)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">
                {{ $cliente_id ? 'Editar cliente' : 'Novo cliente' }}
            </div>

            <div class="card-body">
                <form wire:submit.prevent="salvar">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" wire:model="nome">
                            @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Telefone</label>
                            <input
    type="text"
    class="form-control"
    wire:model.live="telefone"
    maxlength="15"
    oninput="formatarTelefone(this)">
                            
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
    <label class="form-label">CPF/CNPJ</label>

    <input
        type="text"
        class="form-control"
        wire:model.live="cpf_cnpj"
        maxlength="18"
        oninput="formatarCpfCnpj(this)">
</div>

                        <div class="col-md-12 d-flex gap-2">
                            <button class="btn btn-primary">
                                Salvar cliente
                            </button>

                            @if($cliente_id)
                                <button type="button" wire:click="limpar" class="btn btn-outline-secondary">
                                    Cancelar
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            {{ $mostrarArquivados ? 'Clientes arquivados' : 'Clientes ativos' }}
        </div>

        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>CPF/CNPJ</th>
                        <th width="180">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->telefone ?? '-' }}</td>
                            <td>{{ $cliente->email ?? '-' }}</td>
                            <td>{{ $cliente->cpf_cnpj ?? '-' }}</td>
                            <td>
                                @if($mostrarArquivados)
                                    <button wire:click="restaurar({{ $cliente->id }})" class="btn btn-sm btn-success">
                                        Restaurar
                                    </button>
                                @else
                                    <button wire:click="editar({{ $cliente->id }})" class="btn btn-sm btn-warning">
                                        Editar
                                    </button>

                                    <button wire:click="arquivar({{ $cliente->id }})" class="btn btn-sm btn-danger">
                                        Arquivar
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Nenhum cliente encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function formatarCpfCnpj(input)
{
    let value = input.value.replace(/\D/g,'');

    if(value.length <= 11)
    {
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }
    else
    {
        value = value.replace(/^(\d{2})(\d)/, '$1.$2');
        value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
        value = value.replace(/(\d{4})(\d)/, '$1-$2');
    }

    input.value = value;
}
</script>

<script>
function formatarTelefone(input)
{
    let value = input.value.replace(/\D/g,'');

    if(value.length > 11)
        value = value.substring(0,11);

    value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
    value = value.replace(/(\d)(\d{4})$/, '$1-$2');

    input.value = value;
}

function formatarCpfCnpj(input)
{
    let value = input.value.replace(/\D/g,'');

    if(value.length <= 11)
    {
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }
    else
    {
        value = value.replace(/^(\d{2})(\d)/, '$1.$2');
        value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
        value = value.replace(/(\d{4})(\d)/, '$1-$2');
    }

    input.value = value;
}
</script>