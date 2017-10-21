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
                    <form role="form" method="POST" action="{{ url('/password/reset') }}" id="validate">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="text-center mb-3">
                            <h3 class="box-title">Redefinir sua senha!</h3>
                            <p>Crie uma nova senha, preencha os campos abaixo.</p>
                        </div>

                        @include('backend.partials.errors')

                        <fieldset class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" id="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))<label class="error">{{ $errors->first('email') }}</span>@endif
                        </fieldset>

                        <fieldset class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
                            <label for="password">Senha</label>
                            <input type="password" name="password" class="form-control form-control-lg" id="password" required>
                            @if ($errors->has('password'))<label class="error">{{ $errors->first('password') }}</span>@endif
                        </fieldset>

                        <fieldset class="form-group {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" id="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))<label class="error">{{ $errors->first('password_confirmation') }}</span>@endif
                        </fieldset>

                        <button class="btn btn-info btn-block btn-custom" type="submit"> REDEFINIR </button>
                    </form>
                </div>
            </div>

            <footer class="text-center p-1 text-white lead">
                <p><em>Retornar para <a href="{{ url('/auth/login') }}" class="text-white bold">logar</a></em></p>
            </footer>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/g/jquery@3.2.1(jquery.min.js),tether@1.4.0,bootstrap@4.0.0-alpha.6"></script>
</body>
</html>
