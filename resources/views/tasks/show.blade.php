@extends('layouts.app')

@section('title', 'Detalles de la Tarea')

@section('content')
<div class="task-detail">
    <div class="task-detail-header">
        <div class="task-title-section">
            <h2 class="{{ $task->completed ? 'line-through' : '' }}">
                {{ $task->name }}
            </h2>
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
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <div class="task-detail-body">
        <div class="meta-section">
            <h3><i class="fas fa-info-circle"></i> Información</h3>
            <div class="meta-grid">
                <div class="meta-item">
                    <strong>Creada:</strong>
                    {{ $task->created_at->format('d/m/Y H:i') }}
                </div>
                <div class="meta-item">
                    <strong>Última actualización:</strong>
                    {{ $task->updated_at->format('d/m/Y H:i') }}
                </div>
                <div class="meta-item">
                    <strong>Estado:</strong>
                    {{ $task->completed ? 'Completada' : 'Pendiente' }}
                </div>
            </div>
        </div>
    </div>

    <div class="task-detail-actions">
        <form action="{{ route('tasks.toggle-completed', $task) }}" method="POST" class="toggle-form">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-toggle {{ $task->completed ? 'btn-uncomplete' : 'btn-complete' }}">
                @if($task->completed)
                    <i class="fas fa-undo"></i> Marcar como Pendiente
                @else
                    <i class="fas fa-check"></i> Marcar como Completada
                @endif
            </button>
        </form>

        <div class="action-buttons">
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
@endsection