@extends('adminlte::page')

@section('title', 'Listagem de Categorias')

@section('content_header')
    <h1>
        Categorias
    </h1>

    <ol class="breadcrumb"  style="font-size:15px">
        <li><a href="{{ route('admin') }}">Dashboard</a></li>
        <li><a href="{{ route('categories.index') }}" class="active">Categorias</a></li>
    </ol>
@stop

@section('content')
    <div class="content row">

        <div class="box box-success">
            <div class="box-body">
                <form action="{{ route('categories.search') }}" class="form form-inline" method="POST"  style="margin-bottom:15px;">
                    @csrf
                <input type="text" name="title" placeholder="Título" class="form-control" value="{{ $data['title'] ?? '' }}">
                    <input type="text" name="url" placeholder="URL" class="form-control" value="{{ $data['url'] ?? '' }}">
                    <input type="text" name="description" placeholder="Descrição" class="form-control" value="{{ $data['description'] ?? '' }}">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                </form>

                @if (isset($data))
                    <a href="{{ route('categories.index') }}">(x) Limpar Resultados da Pesquisa</a>
                @endif
            </div>
        </div>

        <a href="{{ route('categories.create') }}" class="btn btn-success" style="margin-bottom:20px;">Nova Categoria</a>

        <div class="box box-success">
            <div class="box-body">

                @include('admin.includes.alerts')
                
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Url</th>
                            <th scope="col">Descrição</th>
                            <th width="150px" scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->url }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="badge bg-yellow">
                                    Editar
                                </a>
                                <a href="{{ route('categories.show', $category->id) }}" class="badge bg-primary">
                                    Detalhes
                                </a>
                            </td>
                        </tr>
                        @empty 
                        <tr>
                            <td colspan="200">Nenhuma categoria registrada!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if (isset($data))
                    {!! $categories->appends($data)->links() !!}
                @else
                    {!! $categories->links() !!}
                @endif

            </div>
        </div>
    </div>
@stop