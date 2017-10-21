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
            <div class="card-header">Duplo Fator de Autenticação</div>

            <div class="card-body">
                @if(!Auth::user()->google2fa_secret)
                <p class="lead">
                    Abra seu aplicativo para celular 2FA e escaneie o seguinte QRCode:
                </p>

                <p class="text-center">
                    {{ Html::image($image) }}
                </p>

                <p class="lead">
                Se o seu aplicativo para celular 2FA não suportar códigos de barras QR, digite o número a seguir: <code>{{ $secret }}</code>
                </p>

                <form method="POST" action="{{ route('admin.profile.2fa') }}" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="inputSecret">One-Time Password</label>
                        <input type="text" name="secret" class="form-control" id="inputSecret" aria-describedby="secretHelp">
                        <input type="hidden" name="hash" value="{{ $secret }}">
                        <small id="secretHelp" class="form-text text-muted">Entre com o codigo gerado, para validar a autenticação.</small>
                        <button type="submit" class="btn btn-primary btn-block mt-2">Validar</button>
                    </div>
                </form>
                @endif

                @if(Auth::user()->google2fa_secret)
                <div class="alert alert-danger">
                    @{ data.alert }
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#modal-2fa-account">
                            <i class="fa fa-btn fa-times with-text"></i> Desabilitar 
                        </button>
                    </div>
                </div>

                <!-- Delete Account Modal -->
                <div class="modal fade" id="modal-2fa-account" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Desativar "Duplo Fator de Autenticação" </h4>
                            </div>
                            <div class="modal-body">
                                <p>Tem certeza de que deseja desativar o uso da função de verificação dupla?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Mantenha Usando</button>
                                <button type="submit" class="btn btn-danger" data-disable-with="Desabilitando..." data-method="delete" rel="nofollow" data-remote="true">
                                    <i class="fa fa-btn fa-times with-text"></i> Desabilitar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>                
                @endif
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