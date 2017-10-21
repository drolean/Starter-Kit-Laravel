@if (session()->has("admin_user_id"))
    <div class="alert alert-warning">
        Você está logado como <strong>{{ auth()->user()->name }}</strong>. <a href="{{ route("admin.profile.voltar") }}">Voltar ao login {{ session()->get("admin_user_name") }}</a>.
    </div>
@endif