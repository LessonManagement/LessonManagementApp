@extends('layout.app')
@section('title', 'Profesor - LessonManagement')

@section('menu')
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('') }}">
            <span
                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
            </span>
            <span class="nav-link-title">
                Home
            </span>
        </a>
    </li>
    <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
            data-bs-auto-close="outside" role="button" aria-expanded="false">
            <span
                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
            </span>
            <span class="nav-link-title">
                Profesor
            </span>
        </a>
        <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                    <a class="dropdown-item" href="{{ url('profesor') }}">
                        Lista de profesores
                    </a>
                    <a class="dropdown-item" href="{{ url('profesor/create') }}">
                        Añadir profesor
                    </a>
                </div>
            </div>
        </div>
    </li>
    <li class="nav-item dropdown" >
        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
            data-bs-auto-close="outside" role="button" aria-expanded="false">
            <span
                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
            </span>
            <span class="nav-link-title">
                Grupo
            </span>
        </a>
        <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                    <a class="dropdown-item" href="{{ url('grupo') }}">
                        Lista de grupos
                    </a>
                    <a class="dropdown-item" href="{{ url('grupo/create') }}">
                        Añadir grupo
                    </a>
                </div>
            </div>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
            data-bs-auto-close="outside" role="button" aria-expanded="false">
            <span
                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="icon icon-tabler icon-tabler-stack-middle" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M16 10l4 -2l-8 -4l-8 4l4 2" />
                    <path d="M12 12l-4 -2l-4 2l8 4l8 -4l-4 -2l-4 2z" fill="currentColor" />
                    <path d="M8 14l-4 2l8 4l8 -4l-4 -2" />
                </svg>
            </span>
            <span class="nav-link-title">
                Módulo
            </span>
        </a>
        <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                    <a class="dropdown-item" href="{{ url('modulo') }}">
                        Lista de modulos
                    </a>
                    <a class="dropdown-item" href="{{ url('modulo/create') }}">
                        Añadir modulo
                    </a>
                </div>
            </div>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
            data-bs-auto-close="outside" role="button" aria-expanded="false">
            <span
                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z" /><path d="M19 16h-12a2 2 0 0 0 -2 2" /><path d="M9 8h6" /></svg>
            </span>
            <span class="nav-link-title">
                Formación
            </span>
        </a>
        <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                    <a class="dropdown-item" href="{{ url('formacion') }}">
                        Lista de formaciones
                    </a>
                    <a class="dropdown-item" href="{{ url('formacion/create') }}">
                        Añadir formación
                    </a>
                </div>
            </div>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
            data-bs-auto-close="outside" role="button" aria-expanded="false">
            <span
                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 21v-2a4 4 0 0 1 4 -4h2" /><path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" /><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /></svg>
            </span>
            <span class="nav-link-title">
                Lección
            </span>
        </a>
        <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                    <a class="dropdown-item" href="{{ url('leccion') }}">
                        Lista de lecciones
                    </a>
                </div>
            </div>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
            data-bs-auto-close="outside" role="button" aria-expanded="false">
            <span
                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 21v-2a4 4 0 0 1 4 -4h2" /><path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" /><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /></svg>
            </span>
            <span class="nav-link-title">
                Administrador
            </span>
        </a>
        <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                    <a class="dropdown-item" href="{{ url('formacion') }}">
                        Lista de administradores
                    </a>
                    <a class="dropdown-item" href="{{ url('formacion/create') }}">
                        Añadir administrador
                    </a>
                </div>
            </div>
        </div>
    </li>
</ul>
@endsection

@include('profesor.modals.deleteProfesor')

@section('main-content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="bread-crumbs mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ urL('profesor') }}">Profesor</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('profesor/{profesor}/edit') }}">Editar profesor</a></li>
            </ol>
        </div>
        <div class="card-header">
            <h2 class="page-title">Editar profesor: {{ $profesor->nombre }}</h2>
        </div>
    </div>
</div>
<div class="page-body">
        <div class="container-xl">
            <form class="card" action="{{ url('profesor/' . $profesor->id) }}" method="post">

                @method('put')    
                @csrf
                
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required">Usuario de Séneca</label>
                        <div>
                            <input type="text" class="form-control" name="seneca_username" id="seneca_username" placeholder="Introduce el usuario de séneca..."
                            value="{{ old('seneca_username', $profesor->seneca_username) }}" maxlength="20" minlength="1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Nombre</label>
                        <div>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Introduce el nombre..." 
                            value="{{ old('nombre', $profesor->nombre) }}" maxlength="100" minlength="1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Primer apellido</label>
                        <div>
                            <input type="text" class="form-control" name="apellido1" id="apellido1" placeholder="Introduce el primer apellido..." 
                            value="{{ old('apellido1', $profesor->apellido1) }}" maxlength="100" minlength="1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Segundo apellido</label>
                        <div>
                            <input type="text" class="form-control" name="apellido2" id="apellido2" placeholder="Introduce el segundo apellido..." 
                            value="{{ old('apellido2', $profesor->apellido2) }}" maxlength="100" minlength="1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Email</label>
                        <div>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Introduce el email..." 
                            value="{{ old('email', $profesor->email) }}" maxlength="120" minlength="1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Especialidad</label>
                        <div>
                            <input type="text" class="form-control" name="especialidad" id="especialidad" placeholder="Introduce la especialidad..." 
                            value="{{ old('especialidad', $profesor->especialidad) }}" maxlength="100" minlength="1" required>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Editar profesor</button>
                    </div>
            </form>
            <div class="row g-2">
                <div class="col-6 col-sm-4 col-md-2 col-xl-auto py-3">
                    <a href="{{ url()->previous() }}" class="btn btn-info w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 14l-4 -4l4 -4" />
                            <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                        </svg>
                        Volver
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-2 col-xl-auto py-3">
                    <button type="button" form="deleteProfesorForm" class="btn btn-danger w-100"
                        data-url="{{ url('profesor/' . $profesor->id) }}" data-nombre="{{ $profesor->nombre }}"
                        data-bs-toggle="modal" data-bs-target="#deleteProfesorModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 7l16 0" />
                            <path d="M10 11l0 6" />
                            <path d="M14 11l0 6" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection