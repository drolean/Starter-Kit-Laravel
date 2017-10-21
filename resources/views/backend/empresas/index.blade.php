@extends('layouts.backend')

@section('titulo')
Lista de Empresas
@endsection

@section('conteudo')
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex align-content-center flex-wrap">
            <div class="mr-auto p-2">
                <h5>Lista Total</h5>
                <small>Total de empresas cadastradas <strong>{{ $Empresas->count() }}</strong> </small>
            </div>
            <div class="p-2">
                <a class="btn btn-info" href="{{ route('admin.empresas.create') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar Nova </a>
            </div>
        </div>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Criado em</th>
                        <th>Usuário Master</th>
                        <th>Plano</th>
                        <th>Termina em</th>
                        <th class="text-right">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach( $Empresas as $Empresa )
                    <tr>
                        <td>
                            <a href="{{ route('admin.empresas.edit', $Empresa) }}" >{{ $Empresa->empresa }}</a>
                        </td>
                        <td>{{ $Empresa->created_at->format('d.m.Y h\Hi') }}</td>
                        <td>@if($Empresa->user)<a href="{{ route('admin.usuarios.show', ['id' => $Empresa->user]) }}"> {{ $Empresa->user->name }} </a>@endif</td>
                        <td></td>
                        <td></td>
                        <td class="text-right">
                           <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-primary" href="{{ route('admin.empresas.edit', $Empresa) }}" 
                                    rel="tooltip" title="Editar Empresa"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                                <a class="btn btn-warning" href="{{ route('admin.empresas.destroy', $Empresa) }}" 
                                    rel="tooltip" title="Suspender Empresa" 
                                    data-confirm="Tem certeza que deseja suspender esta empresa?" 
                                    data-method="delete"> <i class="fa fa-ban" aria-hidden="true"></i> </a>

                                <a class="btn btn-danger" href="{{ route('admin.empresas.destroy', $Empresa) }}" 
                                    rel="tooltip" title="Excluir Empresa" 
                                    data-confirm="Tem certeza que deseja excluir este item?" 
                                    data-method="delete"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
</div>
@stop

