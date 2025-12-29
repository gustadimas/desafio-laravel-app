<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nova tarefa</title>
</head>
<body>
    <main>
        <h1>Nova tarefa</h1>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('tarefas.store') }}" method="post">
            @csrf

            <div>
                <label for="titulo">Título</label>
                <input id="titulo" name="titulo" type="text" value="{{ old('titulo') }}" required maxlength="250">
            </div>

            <div>
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" maxlength="500">{{ old('descricao') }}</textarea>
            </div>

            <div>
                <label>
                    <input name="completado" type="checkbox" value="1" {{ old('completado') ? 'checked' : '' }}>
                    Completado
                </label>
            </div>

            <button type="submit">Salvar</button>
        </form>

        <p><a href="{{ route('tarefas.index') }}">Voltar</a></p>
    </main>
</body>
</html>