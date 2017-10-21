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
            <div class="card-header">Alterar Senha</div>

            <div class="card-body">

                {{ Form::model(Auth::user(), ['method' => 'POST', 'route' => ['admin.profile.password'], 'autocomplete' => 'off']) }}
                    <div class="form-group">
                        {{ Form::label('old_password', 'Senha Atual') }}
                        {{ Form::password('old_password', ['class' => 'form-control', 'autocomplete' => 'off']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Nova Senha') }}
                        {{ Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password_confirmation', 'Confirmar Nova Senha') }}
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'autocomplete' => 'off']) }}
                    </div>

                    <button type="submit" class="btn btn-info m-t">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop