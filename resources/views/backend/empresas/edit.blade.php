@extends('layouts.backend')

@section('titulo')
Editar Empresa
@endsection

@section('conteudo')
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Editar empresa</h5>
                <small> </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.empresas.index') }}"> <i class="fa fa-list-alt" aria-hidden="true"></i> Listar Empresas </a>
            </div>
        </div>
    </div>
</div>

{{ Form::model($Companie, ['method' => 'PATCH', 'route' => ['admin.empresas.update', $Companie], 'files' => true, 'class' => 'form-horizontal']) }}
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card">
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
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>            
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h6>Usuário</h6>
                    <small>Usuário(s) vinculado a empresa</small>
                </div>
                <table class="table table-sm mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Last Login</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($Companie->UsersMany as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>admin</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>        

    </div>
</form>
@stop