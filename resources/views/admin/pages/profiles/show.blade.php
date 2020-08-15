@extends('adminlte::page')

@section('title', "Detalhes do Perfil { $profile->name }")

@section('content_header')
<h1>Detalhes do profile <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>
                <strong>Nome: </strong> {{ $profile->name }}
            </li>
            <li>
                <strong>URL: </strong> {{ $profile->url }}
            </li>
            <li>
                <strong>Preço: </strong> R$ {{ number_format($profile->price, 2, ',', '.') }}
            </li>
            <li>
                <strong>Descrição: </strong> {{ $profile->description }}
            </li>
        </ul>

        @include('admin.includes.alerts')
        
        <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Excluir</button>
        </form>

    </div>
</div>
@endsection