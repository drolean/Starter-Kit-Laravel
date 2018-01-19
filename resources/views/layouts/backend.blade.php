<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | @yield('titulo')</title>
    <meta name="author" content="Leandro Ross <leandroross@gmail.com>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ asset('/favicon.png') }}" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="application-name" content="{{ config('app.name') }}" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content=">{{ config('app.name') }}" />
    <meta name="theme-color" content="#4C7FF0" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="csrf-param" content="_token" />
    @if (config('webpush.gcm.sender_id'))
        <link rel="manifest" href="/manifest.json">
    @endif
    <link rel="stylesheet" href="{{ mix('static/css/app.css') }}" type="text/css" />
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        window.Laravel = {!! json_encode([
            'baseUrl' =>  config('starter.ADMIN_ONLY') ? url('/') : url('/') . '/admin',
            'user' => Auth::user(),
            'csrfToken' => csrf_token(),
            'vapidPublicKey' => config('webpush.vapid.public_key'),
            'pusher' => [
                'key' => config('broadcasting.connections.pusher.key'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            ],
        ]) !!};
    </script>
</head>
<body>

    <div class="app" id="dashboard" v-cloak>
        @include('backend.partials.chat')
        <div class="off-canvas-overlay" data-toggle="sidebar"></div>

        <div class="sidebar-panel">
            <div class="brand">
                <a class="brand-logo" href="{{ route('admin.dashboard') }}"> <img src="{{ auth()->user()->Companie->logo }}" alt="{{ config('app.name') }}" /> </a>
            </div>

            <div class="nav-profile dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <div class="user-image"><img src="{{ auth()->user()->gravatar }}" class="avatar" alt="user" title="user"></div>
                    <div class="user-info expanding-hidden"> {{ \Funcoes::truncate(auth()->user()->name, 25) }} <small class="bold"> {{ auth()->user()->email }} </small></div>
                </a>

                <div class="dropdown-menu ml-1">
                    <h6 class="dropdown-header">Menu</h6>
                    <notifications-demo></notifications-demo>
                    <a class="dropdown-item" href="{{ route('admin.profile.show') }}">Perfil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('auth/logout') }}">Sair</a>
                </div>
            </div>

            @include('backend.partials.aside')

        </div>

        <div class="main-panel navbar-expand">
            <nav class="header navbar-nav">
                <div class="header-inner">
                    <div class="d-flex align-content-center flex-nowrap justify-content-end">
                        <div class="mr-auto navbar-item navbar-spacer-right brand hidden-lg-up">
                            <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen text-light" aria-label="Abrir menu lateral"> <i class="fa fa-bars" aria-hidden="true"></i> </a>
                        </div>
                        <p class="navbar-heading"><span> @yield('titulo') </span></p>
                        @if($listaEmpresas->count() >= 2)
                        <div class="pt-1">
                            <div class="nav-item nav-link dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ auth()->user()->Companie->empresa }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach($listaEmpresas as $Empresa)
                                    <a class="dropdown-item" href="javascript:;" @click="toggleCompanie({{ $Empresa->id }})">{{ $Empresa->empresa }}</a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="pt-3">
                            <a href="javascript:void(0);" class="js-search text-white" data-close="true" aria-label="Abrir buscador"> <i class="fa fa-search fa-2x" aria-hidden="true"></i> </a>
                        </div>
                        @if(View::hasSection('ajuda'))
                        <div class="pt-3 ml-3">
                            <a href="@yield('ajuda')" rel="modal" class="text-white" aria-label="Abrir documentação">
                                <i class="fa fa-question-circle fa-2x" aria-hidden="true"></i>
                            </a>
                        </div>
                        @endif
                        <div class="pt-3 ml-3">
                            <a href="javascript:void(null)" class="openChat text-white" aria-label="Abrir chat">
                                <i class="fa fa-commenting-o fa-2x" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="pt-3 ml-3 mr-3">
                            <notifications-dropdown></notifications-dropdown>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="main-content">
                <div class="content-view">

                    @include('backend.partials.logged-in-as')

                    @include('backend.partials.errors')

                    @if($alertas)
                    <div class="alert alert-info text-center">
                        <h4>{{ $alertas->title }}</h4>
                        <p class="lead">{{ $alertas->description }}</p>
                    </div>
                    @endif

                    @yield('conteudo')

                </div>

                <div class="content-footer">
                    <nav class="footer-right">
                        <ul class="nav">
                            <li>Version: {{ config('starter.VERSION') }}</li>
                        </ul>
                    </nav>

                    <nav class="footer-left">
                        <ul class="nav">
                            <li><span>Copyright</span> &copy; {{ date('Y') }} {{ config('app.name') }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @include('backend.partials.helper')
    @include('backend.partials.searchBar')

    <script type="text/javascript" src="{{ mix('static/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ mix('static/js/dashboard.js') }}"></script>
    @yield('footer.script')

    <script>
      if('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js', { scope: '/' })
          .then(function(registration) {
                console.log('Service Worker Registered');
          });
        navigator.serviceWorker.ready.then(function(registration) {
           console.log('Service Worker Ready');
        });
      }
    </script>
</body>
</html>
