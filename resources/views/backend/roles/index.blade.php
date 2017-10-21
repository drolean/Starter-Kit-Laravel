@extends('layouts.backend')

@section('titulo')
Lista de Regras
@endsection

@section('conteudo')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Regras</h5>
                <small>Total de regras cadastradas <strong>{{ $Roles->total() }}</strong> </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.roles.create') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar Nova</a>
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
                        <th>Usuários</th>
                        <th class="text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $Roles as  $Role )
                    <tr>
                        <td><a href="{{ route('admin.roles.show', $Role) }}" >{{ $Role->name }}</a></td>
                        <td>{{ $Role->description }}</td>
                        <td>{{ $Role->UsersList->count() }}</td>
                        <td class="text-right">
                           <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-primary" href="{{ route('admin.roles.edit', $Role) }}"
                                    rel="tooltip" title="Editar Regra"><i class="fa fa-pencil" aria-hidden="true"></i> </a>

                                <a class="btn btn-danger" href="{{ route('admin.roles.destroy', $Role) }}" 
                                    rel="tooltip" title="Excluir Regra" 
                                    data-confirm="Tem certeza que deseja excluir este item?" 
                                    data-method="delete"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $Roles->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>

@stop
