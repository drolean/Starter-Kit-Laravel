@extends('layouts.backend')

@section('titulo')
Ticket's Chamados
@endsection

@section('conteudo')
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Ticket #{{ $Ticket->id }} - {{ $Ticket->titulo }}</h5>
                <small> aberto em {{ $Ticket->created_at->format('d.m.Y h\Hi') }} </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info m-1" href="{{ route('admin.tickets.index') }}"> <i class="fa fa-list-alt" aria-hidden="true"></i> Listar Chamados</a>
                <a class="btn btn-danger m-1" href="{{ route('admin.tickets.update', ['id' => $Ticket, 'status' => 'fechado']) }}" data-confirm="Tem certeza que deseja fechar este item?" data-method="PATCH"> <i class="fa fa-times-circle-o" aria-hidden="true"></i> Fechar Chamado </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-3">
        <div class="card">
            <div class="card-body">
                {{ Form::model($Ticket, ['method' => 'PATCH', 'route' => ['admin.tickets.update', $Ticket], 'files' => true, 'class' => 'form-horizontal']) }}
                    <fieldset class="form-group">
                        <label for="titulo">Titulo</label>
                        {{ Form::text('titulo', old('titulo') , ['class' => 'form-control', 'disabled' => 'disabled']) }}
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="descricao">Descrição</label>
                        <p><strong>{{ $Ticket->descricao }}</strong></p>
                    </fieldset>

                    @foreach($Ticket->comment as $Comentario)
                    <div class="card card-body mb-2">
                        <div class="profile-timeline-header">
                            <div class="profile-timeline-user"><img src="{{ $Comentario->user->gravatar }}" alt="" class="img-rounded"></div>
                            <div class="profile-timeline-user-details">
                                <a href="#" class="bold">{{ $Comentario->user->name }}</a><br>
                                <span class="text-muted small">{{ $Comentario->created_at->format('d.m.Y h\Hi') }} - {{ $Comentario->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="profile-timeline-content">
                            <p>{{ $Comentario->comentario }}</p>
                        </div>
                    </div>
                    @endforeach

                    @if($Ticket->status == 'aberto')
                    <div class="card card-body bg-info-lighter mb-3">
                        <fieldset class="form-group">
                            <label for="comentario">Responder</label>
                            <textarea class="form-control" rows="5" name="comentario" id="comentario">{{ old('comentario') }}</textarea>
                        </fieldset>
                    </div>
                    <button type="submit" class="btn btn-primary">Responder</button>
                    @endif
                </form>

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6>Informações do Chamado</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="list-group no-bg no-border w-100">
                        <div class="list-group-item list-group-item-action no-border">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1">Aberto por</p>
                                <strong>{{ $Ticket->user->name }}</strong>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action no-border">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1"><i class="fa fa-fw fa-circle text-danger"></i>Status</p>
                                <strong class="pull-right">{{ ucfirst($Ticket->status) }}</strong>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action no-border">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1">Prioridade</p>
                                <strong class="pull-right">{{ ucfirst($Ticket->prioridade) }}</strong>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action no-border">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1">Tipo</p>
                                <strong class="pull-right">{{ ucfirst($Ticket->tipo) }}</strong>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action no-border">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1">Criado em</p>
                                <i class="pull-right">{{ $Ticket->created_at->format('d.m.Y h\Hi') }}</i>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action no-border">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1">Ultima interação</p>
                                <i class="pull-right">{{ $Ticket->updated_at->format('d.m.Y h\Hi') }}</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
