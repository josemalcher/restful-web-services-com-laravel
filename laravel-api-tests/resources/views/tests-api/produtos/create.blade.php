@extends('tests-api.layout.template')

@section('content')

    <h1>Cadastrar Novo Produto</h1>


    <a href="{{route('products.index')}}">VOLTAR</a>

    <hr>


    {!! Form::open(['route' => 'products.store', 'class' => 'form']) !!}

    <div class="form-group">
        <label>Nome: </label>
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome Aqui', 'required']) !!}
    </div>
    <div class="form-group">
        <label>Descrição:</label>
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descrição Aqui!', 'required']) !!}
    </div>
    <div class="form-group">
        <input type="submit" value="Enviar" class="btn btn-success">
    </div>

    {!! Form::close() !!}

@endsection