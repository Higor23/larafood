@extends('adminlte::page')

@section('title', "Permissões do Perfil {$profile->name}")

@section('content_header')
<h1>Permissões do Perfil <strong> {{ $profile->name }}  </strong><a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-dark">Adicionar</a></h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item" class="active"><a href="{{ route('profiles.index') }}">Perfis</a></li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('profiles.search')}}" method="POST" class="form form-inline">
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
                       
                        <a href="{{ route('profiles.edit', $permission->id) }}" class="btn btn-info">Editar</a>
                        
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