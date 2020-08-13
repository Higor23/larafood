@extends('adminlte::page')

@section('title', "Detalhes do plano {$plan->name}")"

@section('content_header')
<h1>Detalhes <a href="{{ route('details.plan.create', $plan->url) }}" class="btn btn-dark">Adicionar</a></h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
</ol>
@stop

@section('content')
<div class="card">

    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th width="150">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $detail)
                <tr>
                    <td>{{ $detail->name }}</td>
                    <td style="width:150px">
                        <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-info">Editar</a>
                        <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning">Ver</a>
                    </td>
                </tr>


                @endforeach
            </tbody>
        </table>

    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $details->appends($filters)->links() !!}
        @else
        {!! $details->links() !!}
        @endif

    </div>
</div>

@stop