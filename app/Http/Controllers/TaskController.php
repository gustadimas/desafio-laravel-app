<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tarefas = Task::orderByDesc('id')->get();

        return view('tasks.index', compact('tarefas'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['required', 'max:250'],
            'descricao' => ['nullable', 'max:500'],
            'completado' => ['boolean'],
        ]);

        $data['completado'] = $request->boolean('completado');

        Task::create($data);

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa criada com sucesso.');
    }

    public function edit(Task $tarefa)
    {
        return view('tasks.edit', compact('tarefa'));
    }

    public function update(Request $request, Task $tarefa)
    {
        $data = $request->validate([
            'titulo' => ['required', 'max:250'],
            'descricao' => ['nullable', 'max:500'],
            'completado' => ['boolean'],
        ]);

        $data['completado'] = $request->boolean('completado');

        $tarefa->update($data);

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa atualizada com sucesso.');
    }

    public function destroy(Task $tarefa)
    {
        $tarefa->delete();

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa excluída com sucesso.');
    }
}