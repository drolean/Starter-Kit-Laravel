@extends('layouts.backend')

@section('titulo')
Lista de Usuários
@endsection

@section('conteudo')
<div class="modal fade" id="notification-modal" tabindex="-1" role="dialog" aria-labelledby="EnviarNotificacao">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="EnviarNotificacao">Enviar Notificação</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                
            </div>

            <form data-method="POST" data-remote="true" action="{{ route('admin.profile.notificacoes') }}" method="POST" id="notification">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="user">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Assunto:</label>
                        <input type="text" class="form-control" name="titulo">
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="control-label">Mensagem:</label>
                        <textarea class="form-control" name="mensagem"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                @if(app('request')->input('filter'))
                <h5>Resultados da Busca: {{ $Usuarios->total() }}</h5>
                <small>Total de usários encontrados <strong>{{ $Usuarios->total() }}</strong> </small>
                @else
                <h5>Lista Total</h5>
                <small>Total de usários cadastradas <strong>{{ $Usuarios->total() }}</strong> </small>
                @endif
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.usuarios.create') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar Novo</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form method="GET" >
            <div class="form-group row ">
                <label for="filter" class="col-sm-1 col-form-label">Filtrar: </label>
                <div class="col-sm-10">
                    {{ Form::text('filter', app('request')->input('filter') , ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-1 col-form-label">
                    <a tabindex="0" class="helper mr-sm-2" role="button" 
                        data-toggle="popover" 
                        data-trigger="focus" title="Filtros Disponiveis"
                        data-content="<ul><li>email:<strong>mail@domain.com</strong></li><li>nome:<strong>fulano</strong></li></ul>">            
                    <i class="fa fa-question-circle fa-2x" aria-hidden="true"></i>
                    </a>
                </div>            
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th></th>
                        <th>Criado em</th>
                        <th>Último login</th>
                        <th class="text-right">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach( $Usuarios as $usuario )

                    @if(!Gate::check('is-super', auth()->user()) && $usuario->is_super) 
                        @continue
                    @endif

                    <tr>
                        <td>
                            @if($usuario->isOnline())
                                <span class="badge badge-success p-1 mr-1"> ON </span>
                            @endif
                            <a href="{{ route('admin.usuarios.show', $usuario) }}" >{{ $usuario->name }}</a>
                        </td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            @if($usuario->is_admin)
                                <span class="badge badge-success p-1"> Gerente </span>
                            @endif
                            @if($usuario->is_super)
                                <span class="badge badge-danger p-1"> Super </span>
                            @endif
                        </td>
                        <td></td>
                        <td>{{ $usuario->created_at->format('d/m/Y h\hm') }}</td>
                        <td>@if($usuario->last_login){{ $usuario->last_login->diffForHumans() }}@endif</td>
                        <td class="text-right">
                           <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-danger" href="{{ route('admin.usuarios.destroy', $usuario) }}" 
                                    rel="tooltip" title="Excluir Usuário" 
                                    data-confirm="Tem certeza que deseja excluir este item?" 
                                    data-method="DELETE"> <i class="fa fa-trash" aria-hidden="true"></i> </a>

                                <a class="btn btn-primary" href="javascript:void(null)"
                                    rel="tooltip" title="Enviar notificação ao usuário" 
                                    data-toggle="modal" 
                                    data-target="#notification-modal" 
                                    data-userid="{{ $usuario->id }}" 
                                    data-username="{{ $usuario->name }}" title="Enviar notificação ao usuário"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </a>

                                @if(Auth::user()->is_super)
                                <a class="btn btn-warning" href="{{ route('admin.profile.alternar', $usuario) }}" 
                                    rel="tooltip" title="Logar como Usuário" > <i class="fa fa-sign-in" aria-hidden="true"></i> </a>
                                @endif

                                @if($usuario->blocked_on)
                                <a class="btn btn-outline-danger" href="{{ route('admin.usuarios.update', ['id' => $usuario, 'suspend' => 'false']) }}" 
                                    data-confirm="Tem certeza que deseja remover a suspenção do usuario?" 
                                    data-method="PUT" 
                                    rel="tooltip" title="Remover Suspenção do Usuário"> <i class="fa fa-ban" aria-hidden="true"></i> </a>
                                @else
                                <a class="btn btn-danger" href="{{ route('admin.usuarios.update', ['id' => $usuario, 'suspend' => 'true']) }}" 
                                    data-confirm="Tem certeza que deseja suspender o usuario?" 
                                    data-method="PUT" 
                                    rel="tooltip" title="Suspender Usuário"> <i class="fa fa-ban" aria-hidden="true"></i> </a>
                                @endif

                                @if($usuario->activation == 0)
                                <a class="btn btn-secondary" href="{{ route('admin.usuarios.update', ['id' => $usuario, 'activate' => 'true']) }}" 
                                    data-confirm="Ativar Usuário?" 
                                    data-method="PUT" 
                                    rel="tooltip" title="Ativar Usuário"> <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
            </table>

            {{ $Usuarios->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>
@stop
