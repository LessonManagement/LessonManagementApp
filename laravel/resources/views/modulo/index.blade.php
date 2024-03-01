@extends('layout.app')
@section('title', 'Módulo - LessonManagement')

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
            <li class="nav-item dropdown active">
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
                            <a class="dropdown-item active" href="{{ url('modulo') }}">
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
            <li class="nav-item dropdown">
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

    @include('modulo.modals.deleteModulo')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="bread-crumbs mb-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url('modulo') }}">Módulo</a></li>
                </ol>
            </div>
            <div class="row g-2 d-flex flex-row justify-content-between">
                <div class="col">
                    <h2 class="page-title col-xl-3">
                        Lista de módulos
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <a href="{{ url('modulo/create') }}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Nuevo módulo
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            {{-- TABLA PARA MOSTRAR MODULOS --}}
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Mostrar
                                    <div class="mx-2 d-inline-block">
                                        <select class="form-select form-select-sm" name="rpp" id="rpp"
                                            aria-label="Rows per page" form="rowPerPage">
                                            @foreach ($rpps as $index => $value)
                                                <option value="{{ $index }}"
                                                    {{ $rpp == $index ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <form id="rowPerPage" action="">
                                            <input type="hidden" name="orderBy" value="{{ $orderBy }}" />
                                            <input type="hidden" name="orderType" value="{{ $orderType }}" />
                                            <input type="hidden" name="q" value="{{ $q }}" />
                                        </form>
                                    </div>
                                    entradas
                                </div>
                                <div class="ms-auto text-muted">
                                    Buscar:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label="Search modulo" id="q" name="q" form="search"
                                            placeholder="Buscar...">
                                        <form action="" id="search">
                                            <input type="hidden" name="orderBy" value="{{ $orderBy }}" />
                                            <input type="hidden" name="orderType" value="{{ $orderType }}" />
                                            <input type="hidden" name="rpp" value="{{ $rpp }}" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" style="min-height: 250px">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">
                                            ID
                                            <a href="?rpp={{ $rpp }}&orderBy=modulo.id&orderType=asc&q={{ $q }}"
                                                style="text-decoration: none">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-up" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 11l-6 -6" />
                                                    <path d="M6 11l6 -6" />
                                                </svg>
                                            </a>
                                            <a
                                                href="?rpp={{ $rpp }}&orderBy=modulo.id&orderType=desc&q={{ $q }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-down" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 13l-6 6" />
                                                    <path d="M6 13l6 6" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            Denominación
                                            <a href="?rpp={{ $rpp }}&orderBy=modulo.denominacion&orderType=asc&q={{ $q }}"
                                                style="text-decoration: none">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-up" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 11l-6 -6" />
                                                    <path d="M6 11l6 -6" />
                                                </svg>
                                            </a>
                                            <a
                                                href="?rpp={{ $rpp }}&orderBy=modulo.denominacion&orderType=desc&q={{ $q }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-down" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 13l-6 6" />
                                                    <path d="M6 13l6 6" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            Siglas
                                            <a href="?rpp={{ $rpp }}&orderBy=modulo.siglas&orderType=asc&q={{ $q }}"
                                                style="text-decoration: none">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-up" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 11l-6 -6" />
                                                    <path d="M6 11l6 -6" />
                                                </svg>
                                            </a>
                                            <a
                                                href="?rpp={{ $rpp }}&orderBy=modulo.siglas&orderType=desc&q={{ $q }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-down" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 13l-6 6" />
                                                    <path d="M6 13l6 6" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            Formación
                                            <a href="?rpp={{ $rpp }}&orderBy=formacion.denominacion&orderType=asc&q={{ $q }}"
                                                style="text-decoration: none">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-up" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 11l-6 -6" />
                                                    <path d="M6 11l6 -6" />
                                                </svg>
                                            </a>
                                            <a
                                                href="?rpp={{ $rpp }}&orderBy=formacion.denominacion&orderType=desc&q={{ $q }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-down" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 13l-6 6" />
                                                    <path d="M6 13l6 6" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            Curso
                                            <a href="?rpp={{ $rpp }}&orderBy=modulo.curso&orderType=asc&q={{ $q }}"
                                                style="text-decoration: none">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-up" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 11l-6 -6" />
                                                    <path d="M6 11l6 -6" />
                                                </svg>
                                            </a>
                                            <a
                                                href="?rpp={{ $rpp }}&orderBy=modulo.curso&orderType=desc&q={{ $q }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-down" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 13l-6 6" />
                                                    <path d="M6 13l6 6" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            Horas
                                            <a href="?rpp={{ $rpp }}&orderBy=modulo.horas&orderType=asc&q={{ $q }}"
                                                style="text-decoration: none">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-up" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 11l-6 -6" />
                                                    <path d="M6 11l6 -6" />
                                                </svg>
                                            </a>
                                            <a
                                                href="?rpp={{ $rpp }}&orderBy=modulo.horas&orderType=desc&q={{ $q }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-down" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 13l-6 6" />
                                                    <path d="M6 13l6 6" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            Especialidad
                                            <a href="?rpp={{ $rpp }}&orderBy=modulo.especialidad&orderType=asc&q={{ $q }}"
                                                style="text-decoration: none">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-up" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 11l-6 -6" />
                                                    <path d="M6 11l6 -6" />
                                                </svg>
                                            </a>
                                            <a
                                                href="?rpp={{ $rpp }}&orderBy=modulo.especialidad&orderType=desc&q={{ $q }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-down" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" style="--tblr-icon-size: .9rem">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M18 13l-6 6" />
                                                    <path d="M6 13l6 6" />
                                                </svg>
                                            </a>
                                        </th>
                                        @if (Auth::user()->type == 'admin' || Auth::user()->type == 'root')
                                            <th></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modulos as $modulo)
                                        <tr>
                                            <td>
                                                {{ $modulo->id }}
                                            </td>
                                            <td>
                                                {{ $modulo->denominacion }}
                                            </td>
                                            <td>
                                                {{ $modulo->siglas }}
                                            </td>
                                            <td>
                                                {{ $modulo->formacion }}
                                            </td>
                                            <td>
                                                {{ $modulo->curso }}
                                            </td>
                                            <td>
                                                {{ $modulo->horas }}
                                            </td>
                                            <td>
                                                {{ $modulo->especialidad }}
                                            </td>
                                            @if (Auth::user()->type == 'admin' || Auth::user()->type == 'root')
                                                <td class="text-end">
                                                    <span class="dropdown">
                                                        <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-boundary="viewport"
                                                            data-bs-toggle="dropdown">Acciones</button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item"
                                                                href="{{ url('modulo/' . $modulo->id) }}"
                                                                style="transform: translate3d(0px, auto, 0px)">
                                                                Mostrar
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ url('modulo/' . $modulo->id . '/edit') }}">
                                                                Editar
                                                            </a>
                                                            <button type="button" form="deleteModuloForm"
                                                                class="dropdown-item"
                                                                data-url="{{ url('modulo/' . $modulo->id) }}"
                                                                data-siglas="{{ $modulo->siglas }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteModuloModal">
                                                                Eliminar
                                                            </button>
                                                        </div>
                                                    </span>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">Mostrando <span>{{ $init_mod }}</span> a
                                <span>{{ $last_mod_page }}</span> de
                                <span>{{ $modulo_count }}</span> entradas
                            </p>
                            {{ $modulos->appends(['rpp' => $rpp, 'orderBy' => $orderBy, 'orderType' => $orderType, 'q' => $q])->onEachSide(2)->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById('rpp').addEventListener('change', () => {
                    // Envio del formulario
                    document.getElementById('rowPerPage').submit();
                })
            </script>
        </div>
    </div>
@endsection
