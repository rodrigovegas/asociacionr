@extends('adminlte::page')

@section('title', 'Editar Juez')

@section('content_header')
    <h1>Editar Juez</h1>
@endsection

@section('content')
    @include('jueces.partials.form', [
        'route' => route('jueces.update', $juez),
        'method' => 'PUT',
        'juez' => $juez
    ])
@endsection

