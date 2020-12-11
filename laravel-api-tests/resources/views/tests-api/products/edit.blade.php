@extends('tests-api.layouts.template')

@section('content')

<h1>Editar Produto: {{$product->name}}</h1>

<a href="{{route('products.index')}}">Voltar</a>

{!! Form::model($product, ['route' => ['products.update', $product->id], 'class' => 'form', 'method' => 'put']) !!}

    @include('tests-api.products.form-part')

{!! Form::close() !!}

@endsection