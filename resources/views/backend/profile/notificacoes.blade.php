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
            <div class="card-header">Notificações</div>
            <div class="card-body">
                <div class="list-group">
                    @foreach (Auth::user()->notifications as $key => $Notification)
                    <div class="list-group-item list-group-item-action flex-column align-items-start {{ (!$Notification->read_at ? 'list-group-item-info' : null)  }}">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><a href="{{ $Notification->data['action_url'] }}"> {{ $Notification->data['title'] }} </a></h5>
                            <small> {{ $Notification->created_at->format('d.m.Y H:i:s') }} </small>
                        </div>
                        <p class="mb-1"> {{ $Notification->data['body'] }} </p>
                        @if(!$Notification->read_at)<small> <strong>marcar como lida</strong> </small>@endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@stop
