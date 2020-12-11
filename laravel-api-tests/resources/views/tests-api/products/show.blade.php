@extends('tests-api.layouts.template')

@section('content')

<h1>Nome: {{$product->name}}</h1>
<h2>Descrição: {{$product->description}}</h2>

{!! Form::open(['route' => ['products.destroy', $product->id], 'class' => 'form', 'method' => 'DELETE']) !!}
    <input type="submit" value="Deletar: {{$product->name}}" class="btn btn-danger">
{!! Form::close() !!}

@endsection