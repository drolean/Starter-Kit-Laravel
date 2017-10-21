@extends('layouts.backend')

@section('titulo')
Lista de Permissões
@endsection

@section('conteudo')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Adicionar nova permissão</h5>
                <small> Preencha os campos abaixo para cadastrar uma nova permissão. </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.permissions.index') }}"> <i class="fa fa-list-alt" aria-hidden="true"></i> Listar Permissões</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.permissions.index') }}" class="form-horizontal">
            {{ csrf_field() }}

            <fieldset class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="rota" value="{{ old('name') }}" required autofocus>
                <small class="text-muted">exemplo: 'admin.controller.funcao', 'admin.usuarios.index'</small>
            </fieldset>

            <fieldset class="form-group">
                <label for="label">Label</label>
                <input type="text" name="label" id="label" class="form-control" placeholder="label" value="{{ old('label') }}" required autofocus>
                <small class="text-muted">Nomeação da permissão</small>
            </fieldset>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>

    </div>
</div>
@stop