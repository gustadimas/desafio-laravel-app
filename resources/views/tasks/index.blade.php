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
                                <td>{{ $tarefa->descricao ? \Illuminate\Support\Str::limit($tarefa->descricao, 80) : '-' }}</td>
                                <td>
                                    @if ($tarefa->completado)
                                        <span class="badge text-bg-success">Concluída</span>
                                    @else
                                        <span class="badge text-bg-secondary">Pendente</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('tarefas.edit', $tarefa) }}">Editar</a>
                                    <form
                                        action="{{ route('tarefas.destroy', $tarefa) }}"
                                        method="post"
                                        class="d-inline"
                                        onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?')"
                                    >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                    </form>
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