@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
<h1>Permissões <a href="{{ route('permissions.create') }}" class="btn btn-dark">Adicionar</a></h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item" class="active"><a href="{{ route('permissions.index') }}">Perfis</a></li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('permissions.search')}}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Pesquisar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th width="250">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td style="width:150px">
                       
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info">Editar</a>
                        <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning">Ver</a>
                    </td>
                </tr>


                @endforeach
            </tbody>
        </table>

    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $permissions->appends($filters)->links() !!}
        @else
        {!! $permissions->links() !!}
        @endif

    </div>
</div>

@stop