@extends('layouts.backend')

@section('titulo')
Lista de Alertas
@endsection

@section('conteudo')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Alertas</h5>
                <small>Total de alertas ativos <strong>{{ $Alertas->total() }}</strong> </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.alertas.create') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar Novo</a>
            </div>
        </div>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Inicio</th>
                        <th>Fim</th>
                        <th class="text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $Alertas as  $Alerta )
                    <tr>
                        <td><a href="{{ route('admin.alertas.edit', $Alerta) }}" >{{ $Alerta->title }}</a></td>
                        <td>{{ $Alerta->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($Alerta->start_at)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($Alerta->end_at)->format('d/m/Y') }}</td>
                        <td class="text-right">
                           <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-primary" href="{{ route('admin.alertas.edit', $Alerta) }}"
                                    rel="tooltip" title="Editar Alerta"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                <a class="btn btn-danger" href="{{ route('admin.alertas.destroy', $Alerta) }}" 
                                    rel="tooltip" title="Excluir Alerta" 
                                    data-confirm="Tem certeza que deseja excluir este item?" 
                                    data-method="delete"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $Alertas->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>

@stop
