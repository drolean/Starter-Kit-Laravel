@extends('layouts.email')

@section('conteudo')

<tr>
    <td class="email-body" width="100%" style="width: 100%;margin: 0;padding: 0;border-top: 1px solid #EDEFF2;border-bottom: 1px solid #EDEFF2;background-color: #FFF;">
        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="width: 600px;margin: 0 auto;padding: 0;">
            <tr>
                <td class="content-cell" style="padding: 35px 0;">
                    <div style="max-width: 600px; margin: 0 auto;">
                        <p>Empresa cadastrada em {{ $companie->created_at->format('d/m/Y H:i:s') }}</p>

                        <dl>
                            <dt>Empresa:</dt> <dd>{{ $companie->empresa }}</dd>
                            <dt>CNPJ:</dt> <dd>{{ $companie->cnpj }}</dd>
                            <dt>Telefone:</dt> <dd>{{ $companie->telefone }}</dd>
                            <dt>Endereço:</dt> <dd>{{ $companie->endereco }}</dd>
                            <hr>
                            <dt>Usuario:</dt> <dd>{{ $user->name }}</dd>
                            <dt>Email:</dt> <dd>{{ $user->email }}</dd>
                        </dl>

                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>

@stop