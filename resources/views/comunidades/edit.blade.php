@extends('adminlte::page')

@section('title', 'Editar Comunidad')

@section('content_header')
    <h1>Editar Comunidad</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('comunidades.update', $comunidad) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $comunidad->nombre }}" required>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
                <a href="{{ route('comunidades.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
