@extends('layouts.backend')

@section('titulo')
Lista de Regras
@endsection

@section('conteudo')
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Editar regra</h5>
                <small> Vincule as permissões </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.roles.index') }}"> <i class="fa fa-list-alt" aria-hidden="true"></i> Listar Regras</a>
            </div>
        </div>
    </div>
</div>

{{ Form::model($Role, ['method' => 'PATCH', 'route' => ['admin.roles.update', $Role], 'files' => true, 'class' => 'form-horizontal']) }}
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <fieldset class="form-group">
                        <label for="name">Nome</label>
                        {{ Form::text('name', old('name') , ['class' => 'form-control']) }}
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="description">Descrição</label>
                        {{ Form::text('description', old('description') , ['class' => 'form-control']) }}
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h6>Permissões</h6>
                    <small>Selecione as permissões para vincular a regra</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($Permissions as $Permission)
                        <div class="col-lg-4">
                            <label class="checkbox-inline">
                                {{ Form::checkbox('permissions[]', $Permission->id ) }} <i></i> @if($Permission->label) {{ $Permission->label }} @else {{ $Permission->name }} @endif
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </div>
</form>
@stop