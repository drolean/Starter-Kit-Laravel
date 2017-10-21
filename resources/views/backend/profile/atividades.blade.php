@extends('layouts.backend')

@section('titulo')
Perfil do Usuário
@endsection

@section('conteudo')
<div class="row">
    <div class="col-lg-4">
        @include('backend.profile.nav')
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Registro de Atividades</div>

            <div class="card-body">
                <ul class="list-group">
                    @foreach (Auth::user()->Activity as $key => $Atividade)
                    <li class="list-group-item">
                        <div class="bold">{{ $Atividade->created_at->format('d.m.Y H:i:s') }} ( {{ $Atividade->content_type }} - {{ $Atividade->acao }} )</div>
                        {{ $Atividade->descricao }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@stop
