        <div class="card profile-bio no-border">
            <a class="background" style="background:url(/static/img/bg/005.png);"></a>
            <div class="avatar">
                <img src="{{ Auth::user()->gravatar }}" alt="Avatar">
                <div class="user-details">
                    <div class="user-name"><a href="javascript:;">{{ Auth::user()->name }}</a></div>
                    <p>{{ Illuminate\Foundation\Inspiring::quote() }}</p>
                </div>                
            </div>

            <div class="profile-sidebar">
                <div><hr> </div>            
                <div class="ml-4 mr-4">
                    <div class="mb-4">
                        <p class="bold text-uppercase font-light mb-0">Ultima Ação</p>
                        <p class="mb-0"></p>
                    </div>

                    <div>
                        <p class="bold text-uppercase font-light mb-0">Ultimo Login</p>
                        @if(Auth::user()->last_login) <p class="mb-0">{{ Auth::user()->last_login->format('d.m.Y H:i:s') }}</p> @endif
                    </div>

                    <div><hr> </div>                
                    <div class="profile-reccomendations">
                        <small class="bold text-uppercase">Menu de Perfil</small>
                        <ul class="user-meta">
                            <li><a href="{{ route('admin.profile.show') }}"> Perfil </a></li>
                            <li><a href="{{ route('admin.profile.password') }}"> Alterar Senha </a></li>
                            <li><a href="{{ route('admin.profile.2fa') }}"> Duplo Fator de Autenticação </a></li>
                            <li><a href="{{ route('admin.profile.notificacoes') }}"> Notificações <span class="pull-right badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span> </a></li>
                            <li><a href="{{ route('admin.profile.atividade') }}"> Registro de Atividade </a></li>
                            <li><hr/></li>
                            @can('is-admin', auth()->user())
                            <li><a href="{{ route('admin.profile.logo') }}"> Enviar Logo </a></li>
                            @endcan
                            <li><a href="{{ route('admin.profile.delete') }}"> Deletar Conta </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>