@extends('tests-api.layout.template')

@section('content')

    <h1>Exibição dos Produtos</h1>

    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
        </tr>
        @forelse($products->data as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
            </tr>
        @empty
            <tr>
                <td>Nenhum produto Cadastrado!</td>
            </tr>

        @endforelse
    </table>

@endsection