@extends('adminlte::page')

@section('title', 'Nuevo Juez')

@section('content_header')
    <h1>Registrar Juez</h1>
@endsection

@section('content')
    @include('jueces.partials.form', [
        'route' => route('jueces.store'),
        'method' => 'POST',
        'juez' => null
    ])
@endsection
