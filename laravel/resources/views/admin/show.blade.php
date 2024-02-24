@extends('layout.app')
@section('title', 'Formación - LessonManagement')

@section('menu')
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('') }}">
                <span
                    class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
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
        @if (Auth::user()->email_verified_at != null || Auth::user()->type == 'admin')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span
                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
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
                            @if (Auth::user()->type != 'user')
                                <a class="dropdown-item" href="{{ url('profesor/create') }}">
                                    Añadir profesor
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        @endif
        @if (Auth::user()->email_verified_at != null || Auth::user()->type == 'admin')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span
                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                        </svg>
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
                            @if (Auth::user()->type != 'user')
                                <a class="dropdown-item" href="{{ url('grupo/create') }}">
                                    Añadir grupo
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        @endif
        @if (Auth::user()->email_verified_at != null || Auth::user()->type == 'admin')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span
                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stack-middle"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                            @if (Auth::user()->type != 'user')
                                <a class="dropdown-item" href="{{ url('modulo/create') }}">
                                    Añadir modulo
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        @endif
        @if (Auth::user()->email_verified_at != null || Auth::user()->type == 'admin')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span
                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z" />
                            <path d="M19 16h-12a2 2 0 0 0 -2 2" />
                            <path d="M9 8h6" />
                        </svg>
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
                            @if (Auth::user()->type != 'user')
                                <a class="dropdown-item" href="{{ url('formacion/create') }}">
                                    Añadir formación
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        @endif
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                data-bs-auto-close="outside" role="button" aria-expanded="false">
                <span
                    class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                        <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                    </svg>
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
        @if (Auth::user()->type == 'root' || Auth::user()->type == 'Root')
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h2" />
                            <path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        </svg>
                    </span>
                    <span class="nav-link-title">
                        Administrador
                    </span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            <a class="dropdown-item" href="{{ url('admin') }}">
                                Lista de usuarios
                            </a>
                            <a class="dropdown-item" href="{{ url('admin/create') }}">
                                Añadir usuario
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        @endif
    </ul>
@endsection

@section('main-content')
@include('admin.modals.deleteUser')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="bread-crumbs">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ urL('admin') }}">Admin</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url('admin/{admin}') }}">Visualizar
                            usuario</a></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row d-flex justify-content-evenly ">
                <div class="card mb-5 col-sm-6 col-lg-3">
                    <div class="card-header card-header-black">
                        <h3 class="card-title">Nombre</h3>
                    </div>
                    <div class="card-body">
                        {{ $user->name }}
                    </div>
                </div>
                <div class="card mb-5 col-sm-6 col-lg-3">
                    <div class="card-header card-header-black">
                        <h3 class="card-title">Email</h3>
                    </div>
                    <div class="card-body">
                        {{ $user->email }}
                    </div>
                </div>
                <div class="card mb-5 col-sm-6 col-lg-3">
                    <div class="card-header card-header-black">
                        <h3 class="card-title">Tipo de usuario</h3>
                    </div>
                    <div class="card-body">
                        {{ $user->type }}
                    </div>
                </div>
            </div>
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
                    <a href="{{ url('admin/' . $user->id . '/edit') }}" class="btn btn-warning w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                            <path d="M13.5 6.5l4 4" />
                        </svg>
                        Editar
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-2 col-xl-auto py-3">
                    <button type="button" form="deleteUserForm" class="btn btn-danger w-100"
                        data-url="{{ url('user/' . $user->id) }}" data-nombre="{{ $user->nombre }}"
                        data-bs-toggle="modal" data-bs-target="#deleteUserModal">
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
