@extends('layouts.app')

@section('title', 'Tarefas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Tarefas</h1>
        <a class="btn btn-primary" href="{{ route('tarefas.create') }}">Nova tarefa</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tarefas as $tarefa)
                            <tr>
                                <td class="fw-semibold">{{ $tarefa->titulo }}</td>
                                <td title="{{ $tarefa->descricao ?? '' }}">
                                    {{ $tarefa->descricao ? \Illuminate\Support\Str::limit($tarefa->descricao, 60) : '-' }}
                                </td>
                                <td>
                                    @if ($tarefa->completado)
                                        <span class="badge text-bg-success">Concluída</span>
                                    @else
                                        <span class="badge text-bg-secondary">Pendente</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('tarefas.edit', $tarefa) }}">Editar</a>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-excluir-{{ $tarefa->id }}"
                                    >
                                        Excluir
                                    </button>

                                    @php
                                        $modalId = 'modal-excluir-' . $tarefa->id;
                                        $modalTitleId = $modalId . '-titulo';
                                        $tituloConfirmacao = \Illuminate\Support\Str::limit($tarefa->titulo, 60);
                                    @endphp

                                    <div
                                        class="modal fade"
                                        id="{{ $modalId }}"
                                        tabindex="-1"
                                        aria-labelledby="{{ $modalTitleId }}"
                                        aria-hidden="true"
                                    >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="{{ $modalTitleId }}">Confirmar exclusão</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                </div>
                                                <div class="modal-body" title="{{ $tarefa->titulo }}">
                                                    Tem certeza que deseja excluir a tarefa "{{ $tituloConfirmacao }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('tarefas.destroy', $tarefa) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Nenhuma tarefa cadastrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
