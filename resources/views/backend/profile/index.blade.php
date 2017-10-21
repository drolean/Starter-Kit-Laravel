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
            <div class="card-header"> Alterar Perfil </div>

            <div class="card-body">
                {{ Form::model($Profile = Auth::user(), ['method' => 'POST', 'route' => ['admin.profile.show'], 'files' => true]) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Nome') }}
                        {{ Form::text('name', old('name') , ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        <label>Endereço</label>
                        {{ Form::text('endereco', ($Profile->Profile) ? $Profile->Profile->endereco : null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        <label>Cidade</label>
                        {{ Form::text('cidade', ($Profile->Profile) ? $Profile->Profile->cidade : null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        <label>Telefone</label>
                        {{ Form::text('telefone', ($Profile->Profile) ? $Profile->Profile->telefone : null, ['class' => 'ipt_telefone form-control']) }}
                    </div>

                    <div class="form-group">
                        <label>Aniversário</label>
                        {{ Form::text('aniversario', ($Profile->Profile) ? $Profile->Profile->aniversario : null, ['class' => 'ipt_data form-control']) }}
                    </div>

                    <div class="form-group">
                        <label>Profile Image</label>
                        <br>
                        <label class="custom-file" lang="en">
                            <input type="file" name="avatar" class="custom-file-input" />
                            <span class="custom-file-control" data-content-value="Escolher arquivo..."></span>
                        </label>
                    </div>                    

                    <button type="submit" class="btn btn-info m-t">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer.script')
<style>
.custom-file-control::after {
    content: attr(data-content-value)!important;
}
</style>
<script type="text/javascript">
$(document).ready(function () {
    $('input[type="file"]').on('change', function() {
        $(this).next('.custom-file-control').attr('data-content-value', $(this)[0].files[0].name);
    });
});
</script>
@stop