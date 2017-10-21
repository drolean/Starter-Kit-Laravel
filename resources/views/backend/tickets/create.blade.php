@extends('layouts.backend')

@section('titulo')
Abrir Chamado
@endsection

@section('conteudo')
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Criar novo chamado</h5>
                <small> Preencha os campos abaixo para abrir um novo chamado. </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.tickets.index') }}"> <i class="fa fa-list-alt" aria-hidden="true"></i> Listar Chamados</a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.tickets.index') }}" class="form-horizontal">

            {{ csrf_field() }}

            <fieldset class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Estou tendo um problema na listagem de usuarios" value="{{ old('titulo') }}" required autofocus>
            </fieldset>

            <fieldset class="form-group">
                <label for="tipo">Tipo</label>
                {{ Form::select('tipo', ['bug' => 'Bug', 'tarefa' => 'Tarefa', 'outro' => 'Outro'], old('tipo'), ['placeholder' => 'Tipo de chamado...', 'class' => 'form-control']) }}
            </fieldset>

            <fieldset class="form-group">
                <label for="prioridade">Prioridade</label>
                {{ Form::select('prioridade', ['alta' => 'Alta', 'media' => 'Media', 'baixa' => 'Baixa'], old('prioridade'), ['placeholder' => 'Prioridade do chamado...', 'class' => 'form-control']) }}
            </fieldset>

            <fieldset class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" rows="5" name="descricao" id="descricao">{{ old('descricao') }}</textarea>
            </fieldset>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>

    </div>
</div>
@stop