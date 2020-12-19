@extends('adminlte::page')

@section('title', 'Listagem de Categorias')

@section('content_header')
    <h1>
        Produtos
    </h1>

    <ol class="breadcrumb"  style="font-size:15px">
        <li><a href="{{ route('home') }}">Dashboard</a></li>
        <li><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
    </ol>
@stop

@section('content')
    <div class="content row">

        <div class="box box-success">
            <div class="box-body">
                <form action="{{ route('products.search') }}" method="post" class="form form-inline" style="margin-bottom:15px;">
                    @csrf
                    <select name="category" class="form-control">
                        <option value="">Categoria</option>
                        
                        @foreach ($categories as $id => $category)
                            <option value="{{ $id }}" @if (isset($data['category']) && $data['category'] == $id)
                                selected
                            @endif >{{ $category }}</option>
                        @endforeach
                    </select>

                    <input type="text" name="name" placeholder="Nome:" class="form-control" value="{{ $data['name'] ?? '' }}">

                    <input type="text" name="url" placeholder="Url:" class="form-control" value="{{ $data['url'] ?? '' }}">

                    <input type="text" name="description" placeholder="Descrição:" class="form-control" value="{{ $data['description'] ?? '' }}">

                    <input type="text" name="price" placeholder="Preço:" class="form-control" value="{{ $data['price'] ?? '' }}">

                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                </form>

                @if (isset($data))
                <a href="{{ route('products.index') }}">(x) Limpar Resultados da Pesquisa</a>
            @endif
            </div>
        </div>

        <a href="{{ route('products.create') }}" class="btn btn-success" style="margin-bottom:20px;">Novo produto</a>

        <div class="box box-success">
            <div class="box-body">

                @include('admin.includes.alerts')
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Url</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Preço</th>
                                <th width="150px" scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td> {{ $product->name }} </td>
                                <td> {{ $product->category->title }}</td>
                                <td> {{ $product->url }} </td>
                                <td> {{ $product->description }} </td>
                                <td>R$ {{ $product->price }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="badge bg-yellow">
                                        Editar
                                    </a>
                                    <a href="{{ route('products.show', $product->id) }}" class="badge bg-primary">
                                        Detalhes
                                    </a>
                                </td>
                            </tr>
                            @empty 
                            <tr>
                                <td colspan="200">Nenhum produto registrado!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>  
                @if (isset($filters))
                    {!! $products->appends($filters)->links() !!}
                @else
                    {!! $products->links() !!}
                @endif

            </div>
        </div>
    </div>
@stop