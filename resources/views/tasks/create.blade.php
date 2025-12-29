@extends('layouts.app')

@section('title', 'Nova tarefa')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Nova tarefa</h1>
        <a class="btn btn-outline-secondary" href="{{ route('tarefas.index') }}">Voltar</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('tarefas.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input
                        id="titulo"
                        name="titulo"
                        type="text"
                        class="form-control"
                        value="{{ old('titulo') }}"
                        required
                        maxlength="250"
                    >
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea
                        id="descricao"
                        name="descricao"
                        class="form-control"
                        rows="4"
                        maxlength="500"
                    >{{ old('descricao') }}</textarea>
                </div>

                <div class="form-check mb-4">
                    <input
                        id="completado"
                        name="completado"
                        class="form-check-input"
                        type="checkbox"
                        value="1"
                        {{ old('completado') ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="completado">Completado</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a class="btn btn-outline-secondary" href="{{ route('tarefas.index') }}">Voltar</a>
                </div>
            </form>
        </div>
    </div>
@endsection