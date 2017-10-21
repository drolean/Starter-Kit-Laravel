<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | Recuperar Senha</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="application-name" content="{{ config('app.name') }}" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content=">{{ config('app.name') }}" />
    <meta name="theme-color" content="#4C7FF0" />
    <meta name="description" content="{{ config('app.name') }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="{{ mix('static/css/app.css') }}" type="text/css" />
</head>
<body>

<div class="app layout-static bg-{{ rand(1, 8) }}">
    <div class="session-panel">
        <div class="session">
            <div class="session-content">
                <div class="card card-body form-layout">
                    <form role="form" method="POST" action="{{ route('auth.valida2fa') }}" id="validate">
                        {{ csrf_field() }}
                        <div class="text-center mb-3">
                            <h3 class="box-title">One-Time Password</h3>
                            <p>Digite o token gerado que aparece em seu aparelho</p>
                        </div>

                        @include('backend.partials.errors')

                        <fieldset class="form-group {{ $errors->has('totp') ? 'has-danger' : '' }}">
                            <label for="totp">Token</label>
                            <input type="number" name="totp" class="form-control form-control-lg" id="totp" maxlength="6" required>
                            @if ($errors->has('totp'))<label class="error">{{ $errors->first('totp') }}</span>@endif
                        </fieldset>

                        <button class="btn btn-info btn-block btn-custom" type="submit"> VALIDAR </button>
                    </form>
                </div>
            </div>

            <footer class="text-center p-1 text-white lead">
                <p><em><a href="{{ url('/password/email') }}" class="text-white bold"> Esqueceu sua Senha? </a></em></p>
            </footer>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/g/jquery@3.2.1(jquery.min.js),tether@1.4.0,bootstrap@4.0.0-alpha.6"></script>
</body>
</html>
