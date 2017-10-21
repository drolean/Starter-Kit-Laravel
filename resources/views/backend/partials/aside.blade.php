<nav role="navigation">
    <p class="nav-title text-uppercase text-center">{{ auth()->user()->Companie->empresa }}</p>
    <ul class="nav flex-column">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-fw fa-home text-primary" aria-hidden="true"></i> <span>Home</span></a></li>

        @can('admin.tickets.index', auth()->user())
        <li class="nav-item">
            <a href="javascript:;">
                <span class="menu-caret"><i class="fa fa-caret-down" aria-hidden="true"></i> </span>
                <i class="fa fa-fw fa-ticket" aria-hidden="true"></i>
                <span>Ticket's</span>
            </a>
            <ul class="sub-menu">
                @can('admin.tickets.create', auth()->user())
                <li><a href="{{ route('admin.tickets.create') }}"><span>Abrir Chamado</span></a></li>
                @endcan
                <li><a href="{{ route('admin.tickets.index') }}"><span>Listar Chamados</span></a></li>
            </ul>
        </li>
        @endcan

        @can('is-admin', auth()->user())
        <li class="nav-title">ADMINISTRAÇÃO</li>
        <li class="nav-item">
            <a href="javascript:;">
                <span class="menu-caret"><i class="fa fa-caret-down" aria-hidden="true"></i> </span>
                <i class="fa fa-fw fa-cogs" aria-hidden="true"></i>
                <span>Gestão de Usuários</span>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('admin.usuarios.index') }}"><span>Usuários</span></a></li>
                <li><a href="{{ route('admin.roles.index') }}"><span>Regras 'Roles'</span></a></li>
                @can('is-super', auth()->user())
                <li><a href="{{ route('admin.permissions.index') }}"><span>Permissões 'Rotas'</span></a></li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('is-super', auth()->user())
        <li class="nav-item">
            <a href="javascript:;">
                <span class="menu-caret"><i class="fa fa-caret-down" aria-hidden="true"></i> </span>
                <i class="fa fa-fw fa-wrench text-danger" aria-hidden="true"></i>
                <span>Sistema</span>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('admin.alertas.index') }}"><span>Alertas</span></a></li>
                <li><a href="{{ route('admin.atividades') }}"><span>Atividades</span></a></li>
                <li><a href="{{ route('admin.logs') }}"><span>Logs do Sistema</span></a></li>
            </ul>
        </li>
            @if(config('starter.MULTISAS'))
            <li><a href="{{ route('admin.empresas.index') }}"><i class="fa fa-fw fa-building" aria-hidden="true"></i><span>Empresas</span></a></li>
            <li><a href="{{ route('admin.server') }}"><i class="fa fa-fw fa-server" aria-hidden="true"></i> <span>Servidor</span></a></li>
            @endif 
        @endcan
    </ul>
</nav>
