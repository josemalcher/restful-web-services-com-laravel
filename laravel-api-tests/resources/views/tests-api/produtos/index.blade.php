@extends('tests-api.layout.template')

@section('content')

    <h1>Exibição dos Produtos</h1>

    <a href="{{route('products.create')}}" class="btn btn-success">Cadastrar <span class="glyphicon glyphicon-plus"></span></a>

    <hr>

    @if( session('success') )
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif


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