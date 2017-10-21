@extends('layouts.backend')

@section('titulo')
Alterar Logo da Empresa
@endsection

@section('conteudo')
<div class="row">
    <div class="col-lg-4">
        @include('backend.profile.nav')
    </div>

    <div class="col-lg-8">

        <div class="card">
            <div class="card-header">Alterar Logo</div>

            <div class="card-body">

                {{ Form::model(Auth::user(), ['method' => 'POST', 'route' => ['admin.profile.logo'], 'autocomplete' => 'off', 'files' => true]) }}
                    <div class="form-group">
                        <label>Logo Image</label>
                        <br>
                        <label class="custom-file" lang="en">
                            <input type="file" name="logo" class="custom-file-input" />
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
.custom-file-control:lang(en)::after {
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