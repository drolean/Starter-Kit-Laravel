@extends('layouts.backend')

@section('titulo')
Lista de Notificações
@endsection

@section('conteudo')
<div class="card">
    <div class="card-header">Registro de Notificações</div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sender</th>
                        <th>Receipt</th>
                        <th>Enviado em</th>
                        <th>Titulo</th>
                        <th>Mensagem</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($Notificacoes as $key => $Notification)
                <tr>
                    <th scope="row">{{ $Notification->id }}</th>
                    <td><span class="text-success">{{ $Notification->sender->name }}</span></td>
                    <td><span class="text-success">{{ $Notification->user->name }}</span></td>
                    <td>{{ $Notification->created_at->format('d.m.Y H:i:s') }}</td>
                    <td>{{ $Notification->titulo }}</td>
                    <td>{{ $Notification->conteudo }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@stop
