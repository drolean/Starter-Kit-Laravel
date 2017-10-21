@extends('layouts.backend')

@section('titulo')
Criar novo Usuário
@endsection

@section('conteudo')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Adicionar novo usuário</h5>
                <small> Preencha os campos abaixo para cadastrar um novo usuário. </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.usuarios.index') }}"> <i class="fa fa-list-alt" aria-hidden="true"></i> Listar Usuários</a>
            </div>
        </div> 
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('admin.usuarios.index') }}" class="form-horizontal">
            {{ csrf_field() }}

            <fieldset class="form-group">
                <label for="name">Nome Completo</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nome Completo" value="{{ old('name') }}" required autofocus>
            </fieldset>

            <fieldset class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Endereço de email" value="{{ old('email') }}" required autofocus>
                <small class="text-muted">O endereço de email e único no sistema.</small>
            </fieldset>

            <fieldset class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required>
            </fieldset>

            <fieldset class="form-group">
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar Senha" required>
            </fieldset>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>

    </div>
</div>
@stop