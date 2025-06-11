<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestor de Tareas')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-tasks"></i> Gestor de Tareas</h1>
            <nav class="nav">
                <a href="{{ route('tasks.index') }}" class="nav-link">
                    <i class="fas fa-list"></i> Todas las Tareas
                </a>
                <a href="{{ route('tasks.create') }}" class="nav-link">
                    <i class="fas fa-plus"></i> Nueva Tarea
                </a>
            </nav>
        </header>

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="footer">
            <p>&copy; {{ date('Y') }} Gestor de Tareas - Laravel</p>
        </footer>
    </div>
</body>
</html>