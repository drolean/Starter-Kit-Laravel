@extends('layouts.backend')

@section('titulo')
Atividades dos Usuários
@endsection

@section('conteudo')
<div class="card">
    <div class="card-header">Registro de Atividades</div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Ação</th>
                        <th>Data</th>
                        <th>Usuário</th>
                        <th>Descrição</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($Atividades as $key => $Atividade)
                <tr>
                    <th scope="row">{{ $Atividade->id }}</th>
                    <td><span class="text-success">{{ $Atividade->content_type }}</span></td>
                    <td>{{ $Atividade->acao }}</td>
                    <td>{{ $Atividade->created_at->format('d.m.Y H:i:s') }}</td>
                    <td>@if($Atividade->User)<a href="{{ route('admin.usuarios.show', $Atividade->User) }}" >{{ $Atividade->User->name }}</a>@endif</td>
                    <td>{{ $Atividade->descricao }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@stop