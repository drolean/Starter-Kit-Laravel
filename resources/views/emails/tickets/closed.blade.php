@extends('layouts.email')

@section('conteudo')

<tr>
    <td class="email-body" width="100%" style="width: 100%;margin: 0;padding: 0;border-top: 1px solid #EDEFF2;border-bottom: 1px solid #EDEFF2;background-color: #FFF;">
        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="width: 600px;margin: 0 auto;padding: 0;">
            <tr>
                <td class="content-cell" style="padding: 35px 0;">
                    <div style="max-width: 600px; margin: 0 auto;">
                        <p>Ticket fechado em {{ config('app.name') }}</p>

                        <dl>
                            <dt>Titulo:</dt> <dd>{{ $ticket->titulo }}</dd>
                            <dt>Descrição:</dt> <dd>{{ $ticket->descricao }}</dd>
                            <dt>Tipo:</dt> <dd>{{ $ticket->tipo }}</dd>
                            <dt>Aberto por:</dt> <dd>{{ $user->name }} ({{ $ticket->created_at->format('d/m/Y H:i:s') }})</dd>
                        </dl>
                        @foreach($comentarios as $comentario)
                        <hr />
                        <dl>
                             <dt>Resposta:</dt> <dd>{{ $comentario->comentario }}</dd>
                             <dt>Por:</dt> <dd>{{ $comentario->user->name }}</dd>
                             <dt>Data:</dt> <dd>{{ $comentario->created_at->format('d/m/Y H:i:s') }}</dd>
                        </dl>
                        @endforeach

                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>

@stop