@extends('layouts.backend')

@section('titulo')
Adicionar nova
@endsection

@section('conteudo')
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5> Criar nova </h5>
                <small> </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.empresas.index') }}"> <i class="fa fa-list-alt" aria-hidden="true"></i> Listar Empresas </a>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.empresas.index') }}" class="form-horizontal">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h6>Dados da Empresa</h6>
                    <small>Preencha todos os campos abaixo</small>
                </div>
                <div class="card-body">
                    <fieldset class="form-group">
                        <label for="empresa">Empresa</label>
                        {{ Form::text('empresa', old('empresa') , ['class' => 'form-control']) }}
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="cnpj">CNPJ</label>
                        {{ Form::text('cnpj', old('cnpj') , ['class' => 'ipt_cnpj form-control']) }}
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="telefone">Telefone</label>
                        {{ Form::text('telefone', old('telefone') , ['class' => 'ipt_telefone form-control']) }}
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="endereco">Endereço</label>
                        {{ Form::text('endereco', old('endereco') , ['class' => 'form-control']) }}
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h6>Usuário</h6>
                    <small>Dados do usuário vinculado a empresa</small>
                </div>
                <div class="card-body">
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
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <button type="submit" class="btn btn-primary"> Cadastrar </button>
        </div>
    </div>
</form>
@stop
 