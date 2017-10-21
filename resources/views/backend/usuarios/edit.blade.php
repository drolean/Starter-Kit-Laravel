@extends('layouts.backend')

@section('titulo')
Lista de Usuários
@endsection

@section('conteudo')
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Editar usuário</h5>
                <small> Vincule o usuário a regra </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.usuarios.index') }}"> <i class="fa fa-list-alt" aria-hidden="true"></i> Listar Usuários</a>
            </div>
        </div>
    </div>
</div>

{{ Form::model($Usuario, ['method' => 'PATCH', 'route' => ['admin.usuarios.update', $Usuario], 'files' => true, 'class' => 'form-horizontal']) }}
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <fieldset class="form-group">
                        <label for="name">Nome Completo</label>
                        {{ Form::text('name', old('name') , ['class' => 'form-control']) }}
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="email">Email</label>
                        {{ Form::text('email', old('email') , ['class' => 'form-control', 'disabled' => 'disabled']) }}
                        <small class="text-muted">Alteração de email bloqueada pelo sistema.</small>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h6>Regras</h6>
                    <small>Selecione as regras vinculadas ao usuário</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($Roles as $Role)
                        <div class="col-lg-4">
                            <label class="checkbox-inline">
                                {{ Form::checkbox('roles[]', $Role->id ) }} <i></i> @if($Role->label) {{ $Role->label }} @else {{ $Role->name }} @endif
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </div>
{{ Form::close() }}

@stop
