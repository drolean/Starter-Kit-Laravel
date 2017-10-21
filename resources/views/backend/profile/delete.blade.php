@extends('layouts.backend')

@section('titulo')
Perfil do Usuário
@endsection

@section('conteudo')
<div class="row">
    <div class="col-lg-4">
        @include('backend.profile.nav')
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Deletar Conta</div>

            <div class="card-body">
                <div class="alert alert-danger">
                    Esta ação não é reversível. Todas as informações da conta será excluida, inclusive todos os registros pertencentes.
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#modal-delete-account">
                            <i class="fa fa-btn fa-times with-text"></i> Remover Minha Conta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="modal-delete-account" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Deletar Conta</h4>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que quer apagar sua conta?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Mantenha Usando</button>
                <button type="submit" class="btn btn-danger" data-disable-with="Deletando..." data-method="delete" rel="nofollow" data-remote="true">
                    <i class="fa fa-btn fa-times with-text"></i> Deletar Conta
                </button>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer.script')
<script type="text/javascript">
$(document).ready(function () {
    $('button').bind('ajax:success', function(data, status, xhr) {
        location.reload();
    });
});
</script>
@stop