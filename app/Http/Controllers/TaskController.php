<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
   public function index(Request $request)
{
    $query = Task::with('user');
    
    if ($request->has('user_id') && $request->user_id) {
        $query->where('user_id', $request->user_id);
    }
    
    $tasks = $query->get();
    
    return view('tasks.index', compact('tasks'));
}

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id', 
    ]);

    Task::create([
        'name' => $request->name,
        'user_id' => $request->user_id, 
    ]);

    return redirect()->route('tasks.index');
}


//PRUEBA
public function create()
    {
        $users = User::all();
        
        return view('tasks.create', compact('users'));
    }




    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

   public function edit(Task $task)
{
    $users = \App\Models\User::all();
    
    return view('tasks.edit', compact('task', 'users'));
}

    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
                        ->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')
                        ->with('success', 'Tarea eliminada exitosamente.');
    }

    public function toggleCompleted(Task $task): RedirectResponse
    {
        $task->toggleCompleted();

        $message = $task->completed ? 'Tarea marcada como completada.' : 'Tarea marcada como pendiente.';

        return redirect()->route('tasks.index')
                        ->with('success', $message);
    }
}