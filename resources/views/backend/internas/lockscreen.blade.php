<!DOCTYPE html>
<html lang="pt_br">
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
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1" />
    <link rel="stylesheet" href="{{ mix('static/css/app.css') }}" type="text/css" />
</head>
<body>

<div class="app error-page layout-static">
    <div class="session-panel">
        <div class="session bg-danger">
            <div class="session-content text-center">
                <div>
                    <div class="card no-border no-bg no-shadow">
                        <div class="card-body">
                            <div class="lockscreen-avatar">
                                <img src="{{ Auth::user()->gravatar }}" class="avatar avatar-lg rounded-circle" alt="{{ Auth::user()->name }}" title="{{ Auth::user()->name }}">
                            </div>

                            <h6 class="mt-3 text-white">{{ Auth::user()->name }}</h6>

                            <small class="text-white">Entre com sua senha para desbloquear</small>

                            <div class="lockcode mt-3">
                                <form role="form" method="POST" action="{{ route('admin.lockscreen') }}" id="validate">
                                    {{ csrf_field() }}
                                    <input type="password" class="form-control ba-0 mb-1" id="password" placeholder="Senha"> 
                                    <button class="btn btn-success btn-block ba-0" type="submit">Desbloquear</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
