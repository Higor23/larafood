@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
<h1>Perfis <a href="{{ route('profiles.create') }}" class="btn btn-dark">Adicionar</a></h1>

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
                @foreach($profiles as $profile)
                <tr>
                    <td>{{ $profile->name }}</td>
                    <td style="width:150px">
                       
                        <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-info">Editar</a>
                        <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-warning">Ver</a>
                        <a href="{{ route('profiles.permissions', $profile->id) }}" class="btn btn-warning"><i class="fas fa-lock"</a>
                    </td>
                </tr>


                @endforeach
            </tbody>
        </table>

    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $profiles->appends($filters)->links() !!}
        @else
        {!! $profiles->links() !!}
        @endif

    </div>
</div>

@stop