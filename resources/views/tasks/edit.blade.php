@extends('layouts.app')

@section('title', 'Editar Tarea')

@section('content')
<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-edit"></i> Editar Tarea</h2>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <form action="{{ route('tasks.update', $task) }}" method="POST" class="task-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="form-label">
                <i class="fas fa-heading"></i> Nombre de la Tarea *
            </label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-input @error('name') error @enderror" 
                   value="{{ old('name', $task->name) }}" 
                   required 
                   placeholder="Ingresa el nombre de la tarea">
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="task-status-info">
            <div class="status-indicator {{ $task->completed ? 'completed' : 'pending' }}">
                @if($task->completed)
                    <i class="fas fa-check-circle"></i> Esta tarea está completada
                @else
                    <i class="fas fa-clock"></i> Esta tarea está pendiente
                @endif
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Actualizar Tarea
            </button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection