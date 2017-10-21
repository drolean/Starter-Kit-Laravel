@extends('layouts.backend')

@section('titulo')
Criar novo Alerta
@endsection

@section('conteudo')
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5> Criar novo alerta </h5>
                <small> </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.alertas.index') }}"> <i class="fa fa-list-alt" aria-hidden="true"></i> Listar Alertas</a>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.alertas.index') }}" class="form-horizontal">

    {{ csrf_field() }}

    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <fieldset class="form-group">
                        <label for="title">Título</label>
                        {{ Form::text('title', old('title') , ['class' => 'form-control']) }}
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="description">Descrição</label>
                        {{ Form::textarea('description', old('description') , ['class' => 'form-control']) }}
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h6>Visibilidade</h6>
                    <small>Defina a data inicial e a data final do alerta.</small>
                </div>
                <div class="card-body">

                    <fieldset class="form-group">
                        <label for="start_at">Data inicio</label>
                        {{ Form::date('start_at', old('start_at') , ['class' => 'form-control']) }}
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="end_at">Data final</label>
                        {{ Form::date('end_at', old('end_at') , ['class' => 'form-control']) }}
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
