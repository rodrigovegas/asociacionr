@extends('adminlte::page')

@section('title', 'Crear Comunidad')

@section('content_header')
    <h1>Nueva Comunidad</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('comunidades.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success mt-2">Guardar</button>
                <a href="{{ route('comunidades.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
