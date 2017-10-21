@extends('layouts.backend')

@section('titulo')
Logs do Sistema
@endsection

@section('conteudo')
<div class="card">
    <div class="card-header">Logs do Sistema</div>

    <div class="card-body">
        <div class="list-group">
            @foreach ($Logs as $key => $Log)
            <div class="list-group-item">
                <strong>{{ $Log['date'] }} ( {{ $Log['level'] }} )</strong>
                <div class="w-100">
                    @if ($Log['stack']) <a class="pull-right expand" data-display="stack{{ $key }}"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></a>@endif
                    {{ $Log['text'] }}
                    @if (isset($Log['in_file'])) <br />{{ $Log['in_file'] }}@endif
                    @if ($Log['stack']) <div class="bg-dark-lighter" id="stack{{ $key }}" style="display: none; white-space: pre-wrap;padding: 10px 25px;border-color: #777;margin: 5px 0;">{{ trim($Log['stack']) }}</div>@endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop
