<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | Login</title>
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
    <script type="text/javascript" src="{{ mix('static/js/app.js') }}"></script>
</head>
<body>

<div class="app layout-static bg-{{ rand(1, 8) }}">
    <div class="session-panel">
        <div class="session">
            <div class="session-content">
                <div class="card card-body form-layout">
                    <form role="form" method="POST" action="{{ url('/auth/login') }}" id="validate">
                        {{ csrf_field() }}
                        <div class="text-center mb-3">
                            <h3 class="box-title">Entrar</h3>
                        </div>

                        @include('backend.partials.errors')

                        <fieldset class="form-group my-4 {{ $errors->has('email') ? 'has-danger' : '' }}">
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required placeholder="Email" aria-label="Email">
                        </fieldset>

                        <fieldset class="form-group my-4 {{ $errors->has('password') ? 'has-danger' : '' }}">
                            <input type="password" name="password" class="form-control" id="password" required minlength="3" placeholder="Senha" aria-label="Senha">
                            @if ($errors->has('password'))<label class="error">{{ $errors->first('password') }}</span>@endif
                        </fieldset>

                        <label class="custom-control custom-checkbox mb-4">
                            <input type="checkbox" class="custom-control-input" name="remember">
                            <span class="custom-control-label">Manter conectado?</span>
                        </label>

                        <button class="btn btn-info btn-block btn-custom" type="submit"> LOGIN </button>
                    </form>

                    <div class="divider"><span>OU</span></div>

                    <div class="text-center">
                        @if(config('services.facebook.client_id'))<a href="{{ route('auth.provider', 'facebook') }}"><button class="btn btn-icon-icon btn-facebook mb-1 mr-1" aria-label="entrar com facebook"><i class="fa fa-facebook"></i></button></a>@endif
                        @if(config('services.github.client_id'))<a href="{{ route('auth.provider', 'github') }}"><button class="btn btn-icon-icon btn-github mb-1 mr-1" aria-label="entrar com github"><i class="fa fa-github"></i></button></a>@endif
                        @if(config('services.google.client_id'))<a href="{{ route('auth.provider', 'google') }}"><button class="btn btn-icon-icon btn-googleplus mb-1 mr-1" aria-label="entrar com google"><i class="fa fa-google"></i></button></a>@endif
                        @if(config('services.twitter.client_id'))<a href="{{ route('auth.provider', 'twitter') }}"><button class="btn btn-icon-icon btn-twitter mb-1 mr-1" aria-label="entrar com twitter"><i class="fa fa-twitter"></i></button></a>@endif
                    </div>
                </div>
            </div>
            <footer class="text-center p-1 text-white lead">
                <p><em><a href="{{ url('/password/email') }}" class="text-white bold"> Esqueceu sua Senha? </a></em></p>
            </footer>
        </div>
    </div>
</div>
</body>
</html>
