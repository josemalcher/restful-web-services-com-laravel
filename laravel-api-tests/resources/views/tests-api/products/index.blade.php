@extends('tests-api.layouts.template')

@section('content')

<h1>Exibição dos Produtos:</h1>

@if( session('success') )
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

<a href="{{route('products.create')}}" class="btn btn-success">Cadastrar <span class="glyphicon glyphicon-plus"></span></a>

<table class="table table-striped">
    <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Ações</th>
    </tr>
    @forelse($products->data as $product)
    <tr>
        <td>{{$product->name}}</td>
        <td>{{$product->description}}</td>
        <td>
            <a href="{{route('products.edit', $product->id)}}">
                Editar
            </a>
            <a href="{{route('products.show', $product->id)}}">
                View
            </a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="20">Nenhum Produto Cadastrado!</td>
    </tr>
    @endforelse
</table>


<nav aria-label="Page navigation">
  <ul class="pagination">
    @if( $products->prev_page_url != '' )
        <li>
          <a href="{{route('products.paginate', $products->current_page - 1)}}" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
    @endif

    <li class="action"><a href="#">{{$products->current_page}}</a></li>
    
    @if( $products->next_page_url != '' )
        <li>
          <a href="{{route('products.paginate', $products->current_page + 1)}}" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
    @endif
  </ul>
</nav>

@endsection