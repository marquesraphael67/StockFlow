<div>
    <style>
        .motion-div {
            animation: fadeUp .45s ease both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .client-card {
            border: 0;
            border-radius: 24px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
            background: rgba(255,255,255,.86);
            backdrop-filter: blur(18px);
        }

        .client-hero {
            background: linear-gradient(135deg, #0f172a, #2563eb);
            color: white;
            border-radius: 26px;
            padding: 28px;
            box-shadow: 0 22px 50px rgba(37, 99, 235, .25);
        }

        .icon-soft {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8f1ff;
            color: #2563eb;
            font-size: 22px;
        }

        .table tbody tr {
            transition: .2s;
        }

        .table tbody tr:hover {
            transform: scale(1.005);
            background: rgba(37, 99, 235, .04);
        }

        body.dark-mode .client-card {
            background: rgba(30,41,59,.9) !important;
            color: #e2e8f0 !important;
        }
    </style>

    @if(session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-4" style="z-index: 9999;">
            <div id="successToast" class="toast show border-0 shadow-lg" role="alert">
                <div class="toast-header bg-success text-white">
                    <i class="bi bi-check-circle me-2"></i>
                    <strong class="me-auto">Sucesso</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <div class="client-hero mb-4 motion-div">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="fw-bold mb-1">Clientes</h1>
                <p class="mb-0 opacity-75">Cadastre, edite e organize seus clientes em um só lugar.</p>
            </div>

            <div class="d-flex gap-2">
                <button wire:click="$toggle('mostrarArquivados')" class="btn btn-light">
                    <i class="bi {{ $mostrarArquivados ? 'bi-people' : 'bi-archive' }} me-2"></i>
                    {{ $mostrarArquivados ? 'Ver ativos' : 'Ver arquivados' }}
                </button>

                @if(!$mostrarArquivados)
                    <button wire:click="limpar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clienteModal">
                        <i class="bi bi-person-plus me-2"></i>
                        Novo cliente
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="client-card motion-div">
        <div class="card-header bg-transparent border-0 p-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-soft">
                    <i class="bi bi-people"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-0">
                        {{ $mostrarArquivados ? 'Clientes arquivados' : 'Clientes ativos' }}
                    </h5>
                    <small class="text-muted">Lista de clientes cadastrados na empresa.</small>
                </div>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>CPF/CNPJ</th>
                            <th width="190">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($clientes as $cliente)
                            <tr class="motion-div">
                                <td>
                                    <strong>{{ $cliente->nome }}</strong>
                                    <div class="text-muted small">Cliente cadastrado</div>
                                </td>

                                <td>
                                    @if($cliente->telefone)
                                        <span class="badge bg-light text-dark">
                                            <i class="bi bi-telephone me-1"></i>
                                            {{ $cliente->telefone }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>{{ $cliente->email ?? '-' }}</td>

                                <td>{{ $cliente->cpf_cnpj ?? '-' }}</td>

                                <td>
                                    @if($mostrarArquivados)
                                        <button wire:click="restaurar({{ $cliente->id }})" class="btn btn-sm btn-success">
                                            <i class="bi bi-arrow-clockwise me-1"></i>
                                            Restaurar
                                        </button>
                                    @else
                                        <button
                                            wire:click="editar({{ $cliente->id }})"
                                            class="btn btn-sm btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#clienteModal">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button
                                            wire:click="arquivar({{ $cliente->id }})"
                                            onclick="return confirm('Deseja arquivar este cliente?')"
                                            class="btn btn-sm btn-danger">
                                            <i class="bi bi-archive"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-people fs-1 d-block mb-2"></i>
                                    Nenhum cliente encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CLIENTE --}}
    <div wire:ignore.self class="modal fade" id="clienteModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 26px; overflow: hidden;">
                <div class="modal-header border-0 text-white" style="background: linear-gradient(135deg, #0f172a, #2563eb);">
                    <div>
                        <h5 class="modal-title fw-bold">
                            {{ $cliente_id ? 'Editar cliente' : 'Novo cliente' }}
                        </h5>
                        <small class="opacity-75">Preencha os dados do cliente.</small>
                    </div>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit.prevent="salvar">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control form-control-lg" wire:model="nome">
                                @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Telefone</label>
                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    wire:model.live="telefone"
                                    maxlength="15"
                                    oninput="formatarTelefone(this)">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control form-control-lg" wire:model="email">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">CPF/CNPJ</label>
                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    wire:model.live="cpf_cnpj"
                                    maxlength="18"
                                    oninput="formatarCpfCnpj(this)">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 p-4">
                        @if($cliente_id)
                            <button type="button" wire:click="limpar" class="btn btn-outline-secondary">
                                Cancelar edição
                            </button>
                        @endif

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Fechar
                        </button>

                        <button class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-2"></i>
                            Salvar cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function formatarTelefone(input) {
            let value = input.value.replace(/\D/g,'');

            if(value.length > 11) {
                value = value.substring(0,11);
            }

            value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
            value = value.replace(/(\d)(\d{4})$/, '$1-$2');

            input.value = value;
        }

        function formatarCpfCnpj(input) {
            let value = input.value.replace(/\D/g,'');

            if(value.length <= 11) {
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

        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.getElementById('successToast');

            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3500
                });

                toast.show();
            }
        });
    </script>
</div>