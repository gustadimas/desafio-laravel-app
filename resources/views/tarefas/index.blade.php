<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tarefas</title>
</head>
<body>
    <main>
        <h1>Tarefas</h1>

        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <p><a href="{{ route('tarefas.create') }}">Nova tarefa</a></p>

        @if ($tarefas->isEmpty())
            <p>Nenhuma tarefa cadastrada.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Completado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tarefas as $tarefa)
                        <tr>
                            <td>{{ $tarefa->titulo }}</td>
                            <td>{{ $tarefa->descricao }}</td>
                            <td>{{ $tarefa->completado ? 'Sim' : 'Não' }}</td>
                            <td>
                                <a href="{{ route('tarefas.edit', $tarefa) }}">Editar</a>
                                <form action="{{ route('tarefas.destroy', $tarefa) }}" method="post" style="display:inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </main>
</body>
</html>