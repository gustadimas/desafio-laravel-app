<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar tarefa</title>
</head>
<body>
    <main>
        <h1>Editar tarefa</h1>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('tarefas.update', $tarefa) }}" method="post">
            @csrf
            @method('put')

            <div>
                <label for="titulo">Título</label>
                <input id="titulo" name="titulo" type="text" value="{{ old('titulo', $tarefa->titulo) }}" required maxlength="250">
            </div>

            <div>
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" maxlength="500">{{ old('descricao', $tarefa->descricao) }}</textarea>
            </div>

            <div>
                <label>
                    <input name="completado" type="checkbox" value="1" {{ old('completado', $tarefa->completado) ? 'checked' : '' }}>
                    Completado
                </label>
            </div>

            <button type="submit">Atualizar</button>
        </form>

        <p><a href="{{ route('tarefas.index') }}">Voltar</a></p>
    </main>
</body>
</html>