<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Error 403 - Forbidden</title>

        <!-- Fonts -->
        <link href="//fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Droid Sans', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                line-height: 25px;
                font-size: 14px;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: left;
                width:768px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <h1>Unn</h1>
                <h2>Server Error: 403 (Forbidden)</h2>
                <hr>
                <h3>O que isto significa?</h3>
                @if (session()->has('nop'))
                    {{ session()->get('nop') }}
                @else
                    <p>Você não tem as credenciais certas para ver a página solicitada.</p>
                    <p>
                        Talvez você gostaria de ir para a <a href="/">página inicial</a>?
                    </p>
                @endif
            </div>
        </div>    
    </body>
</html>
