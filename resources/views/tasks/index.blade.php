@extends('layouts.app')

@section('title', 'Lista de Tareas')

@section('content')
<div class="tasks-header">
    <h2><i class="fas fa-clipboard-list"></i> Lista de Tareas</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nueva Tarea
    </a>
</div>

@if($tasks->isEmpty())
    <div class="empty-state">
        <i class="fas fa-clipboard-list"></i>
        <h3>No hay tareas registradas</h3>
        <p>Comienza creando tu primera tarea</p>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Crear Primera Tarea
        </a>
    </div>
@else
    <div class="tasks-grid">
        @foreach($tasks as $task)
            <div class="task-card {{ $task->completed ? 'completed' : 'pending' }}">
                <div class="task-header">
                    <h3 class="task-title {{ $task->completed ? 'line-through' : '' }}">
                        {{ $task->name }}
                    </h3>
                    <div class="task-status">
                        @if($task->completed)
                            <span class="status-badge completed">
                                <i class="fas fa-check"></i> Completada
                            </span>
                        @else
                            <span class="status-badge pending">
                                <i class="fas fa-clock"></i> Pendiente
                            </span>
                        @endif
                    </div>
                </div>

                <div class="task-body">
                    <div class="task-meta">
                        <small>
                            <i class="fas fa-calendar"></i>
                            Creada: {{ $task->created_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>

                <div class="task-actions">
                    <form action="{{ route('tasks.toggle-completed', $task) }}" method="POST" class="toggle-form">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-toggle {{ $task->completed ? 'btn-uncomplete' : 'btn-complete' }}">
                            @if($task->completed)
                                <i class="fas fa-undo"></i> Marcar Pendiente
                            @else
                                <i class="fas fa-check"></i> Completar
                            @endif
                        </button>
                    </form>

                    <div class="action-buttons">
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-secondary">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection