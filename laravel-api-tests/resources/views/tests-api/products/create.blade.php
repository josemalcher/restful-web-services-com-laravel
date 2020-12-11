@extends('tests-api.layouts.template')

@section('content')

<h1>Cadastrar Novo Produto:</h1>

<a href="{{route('products.index')}}">Voltar</a>

{!! Form::open(['route' => 'products.store', 'class' => 'form']) !!}

    @include('tests-api.products.form-part')

{!! Form::close() !!}

@endsection