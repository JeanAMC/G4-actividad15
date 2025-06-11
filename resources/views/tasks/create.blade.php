@extends('layouts.app')

@section('title', 'Crear Nueva Tarea')

@section('content')
<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-plus"></i> Crear Nueva Tarea</h2>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <form action="{{ route('tasks.store') }}" method="POST" class="task-form">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">
                <i class="fas fa-heading"></i> Nombre de la Tarea *
            </label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-input @error('name') error @enderror" 
                   value="{{ old('name') }}" 
                   required 
                   placeholder="Ingresa el nombre de la tarea">
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- AGREGAR ESTE CAMPO -->
        <div class="form-group">
            <label for="user_id" class="form-label">
                <i class="fas fa-user"></i> Usuario *
            </label>
            <select id="user_id" 
                    name="user_id" 
                    class="form-input @error('user_id') error @enderror" 
                    required>
                <option value="">Selecciona un usuario</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Crear Tarea
            </button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection