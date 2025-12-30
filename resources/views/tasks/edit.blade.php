@extends('layouts.app')

@section('title', 'Editar tarefa')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Editar tarefa</h1>
        <a class="btn btn-outline-secondary" href="{{ route('tarefas.index') }}">Voltar</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('tarefas.update', $tarefa) }}" method="post">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input
                        id="titulo"
                        name="titulo"
                        type="text"
                        class="form-control @error('titulo') is-invalid @enderror"
                        value="{{ old('titulo', $tarefa->titulo) }}"
                        required
                        maxlength="250"
                    >
                    @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea
                        id="descricao"
                        name="descricao"
                        class="form-control @error('descricao') is-invalid @enderror"
                        rows="4"
                        maxlength="500"
                    >{{ old('descricao', $tarefa->descricao) }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input type="hidden" name="completado" value="0">
                    <input
                        id="completado"
                        name="completado"
                        class="form-check-input"
                        type="checkbox"
                        value="1"
                        {{ old('completado', $tarefa->completado) ? 'checked' : '' }}
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            const taskId = @json($tarefa->id);
            const storageKey = `tarefas:draft:${taskId}`;
            const fields = {
                titulo: document.getElementById('titulo'),
                descricao: document.getElementById('descricao'),
                completado: document.getElementById('completado'),
            };

            const loadDraft = () => {
                const raw = localStorage.getItem(storageKey);
                if (!raw) return;

                try {
                    const data = JSON.parse(raw);
                    if (fields.titulo) {
                        fields.titulo.value = data.titulo ?? fields.titulo.value;
                    }
                    if (fields.descricao) {
                        fields.descricao.value = data.descricao ?? fields.descricao.value;
                    }
                    if (fields.completado) {
                        fields.completado.checked = Boolean(data.completado);
                    }
                } catch (error) {
                    localStorage.removeItem(storageKey);
                }
            };

            const saveDraft = () => {
                const payload = {
                    titulo: fields.titulo ? fields.titulo.value : '',
                    descricao: fields.descricao ? fields.descricao.value : '',
                    completado: fields.completado ? fields.completado.checked : false,
                };
                localStorage.setItem(storageKey, JSON.stringify(payload));
            };

            if (form) {
                form.addEventListener('input', saveDraft);
                form.addEventListener('change', saveDraft);
                form.addEventListener('submit', () => localStorage.removeItem(storageKey));
            }

            loadDraft();
        });
    </script>
@endsection
