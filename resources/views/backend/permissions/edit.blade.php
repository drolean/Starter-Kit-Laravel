@extends('layouts.backend')

@section('titulo')
Lista de Permissões
@endsection

@section('conteudo')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Editar permissão</h5>
                <small>  </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.empresas.create') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar Nova </a>
            </div>
        </div>
    </div>

    <div class="card-body">

        {{ Form::model($Permissao, ['method' => 'PATCH', 'route' => ['admin.permissions.update', $Permissao], 'files' => true, 'class' => 'form-horizontal']) }}

            <fieldset class="form-group">
                <label for="name">Nome</label>
                {{ Form::text('name', old('name') , ['class' => 'form-control']) }}
            </fieldset>

            <fieldset class="form-group">
                <label for="label">Label</label>
                {{ Form::text('label', old('label') , ['class' => 'form-control']) }}
            </fieldset>

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </div>
</div>
@stop