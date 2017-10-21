@extends('layouts.backend')

@section('titulo')
Lista de Permissões
@endsection

@section('conteudo')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Permissões</h5>
                <small>Total de permissões cadastradas <strong>{{ $Permissoes->total() }}</strong> </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.permissions.create') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar Nova</a>
            <a class="btn btn-info" href="{{ route('admin.permissions.gerar') }}"> <i class="fa fa-magic" aria-hidden="true"></i> Gerar Lista </a>
            </div>
        </div>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Permissão</th>
                        <th>Label</th>
                        <th class="text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $Permissoes as  $Permissao )
                    <tr>
                        <td><a href="{{ route('admin.permissions.show', $Permissao) }}" >{{ $Permissao->name }}</a></td>
                        <td>{{ $Permissao->label }}</td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-primary" href="{{ route('admin.permissions.edit', $Permissao) }}"
                                    rel="tooltip" title="Editar Permissão"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                                <a class="btn btn-danger" href="{{ route('admin.permissions.destroy', $Permissao) }}" 
                                    rel="tooltip" title="Excluir Permissão" 
                                    data-confirm="Tem certeza que deseja excluir este item?" 
                                    data-method="delete"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $Permissoes->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>
@stop
