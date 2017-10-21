@if ( count($errors) > 0 )
<div class="alert alert-danger">
    <strong>Whoops</strong> Ocorreu algum erro.<br><br>
    @foreach ($errors->all() as $error)
        <p class="list-group-item md-whiteframe-z0 b-success">{{ $error }}</p>
    @endforeach
</div>
@endif

@if ( session('info') )
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{ session('info') }}
</div>
@endif

@if ( session('warning') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{ session('warning') }}
</div>
@endif

@if ( session('success') )
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{ session('success') }}
</div>
@endif

@if ( session('error') )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{ session('error') }}
</div>
@endif

@if ( session('status') )
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{ session('status') }}
</div>
@endif