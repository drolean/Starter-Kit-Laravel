@extends('layouts.backend')

@section('titulo')
Ticket's Chamados
@endsection

@section('conteudo')
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Chamados em aberto: {{ $Tickets->where('status', 'aberto')->count() }}</h5>
                <small>Total de tickets <strong>{{ $Tickets->total() }}</strong> </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.tickets.create') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Abrir Chamado</a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Prioridade</th>
                        <th>Usuário</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Último evento</th>
                        <th class="text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $Tickets as $Ticket )
                    <tr>
                        <td>
                            <a href="{{ route('admin.tickets.show', $Ticket) }}" >{{ $Ticket->titulo }}</a>
                        </td>
                        <td class="text-center">
                            @if($Ticket->prioridade == 'alta')
                            <span class="label red"></span>
                            <div class="bg-danger text-white">Alta</div>
                            @elseif($Ticket->prioridade == 'media')
                            <span class="label deep-orange">Media</span>
                            @else
                            <span class="label light-blue">Baixa</span>
                            @endif
                        </td>
                        <td>{{ $Ticket->user->name }}</td>
                        <td>{{ $Ticket->tipo }}</td>
                        <td class="text-center">
                            @if($Ticket->status == 'aberto')
                            <div class="bg-warning text-white">Aberto</div>
                            @else
                            <span>Fechado</span>
                            @endif
                        </td>
                        <td>{{ $Ticket->updated_at->diffForHumans() }}</td>
                        <td class="text-right">
                        @if($Ticket->status == 'aberto')
                           <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-primary" href="{{ route('admin.tickets.edit', $Ticket) }}"
                                    rel="tooltip" title="Editar Ticket"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                                <a class="btn btn-danger" href="{{ route('admin.tickets.update', ['id' => $Ticket, 'status' => 'fechado']) }}" 
                                    rel="tooltip" title="Fechar Ticker" 
                                    data-confirm="Tem certeza que deseja fechar este item?" 
                                    data-method="PATCH"> <i class="fa fa-times-circle-o" aria-hidden="true"></i> </a>
                            </div>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $Tickets->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>

@stop