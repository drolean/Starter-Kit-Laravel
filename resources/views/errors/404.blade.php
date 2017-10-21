<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Erro 404 - Página não encontrada.</title>

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
                <?php $messages = ['Precisamos de um mapa.', 'Eu acho que estamos perdidos.', 'Ooops!', '']; ?>
                <h1>{{ $messages[mt_rand(0, 2)] }}</h1>
                <h2>Erro: 404 (Página não encontrada)</h2>
                <hr>
                <h3>O que isto significa?</h3>
                <p>
                    Não foi possível encontrar a página solicitada em nossos servidores. Estamos muito triste
                    sobre isso. A culpa é nossa, não sua. Vamos trabalhar duro para conseguir esta página
                    novamente on-line o mais rapidamente possível.
                </p>
                <p>
                    Talvez você gostaria de ir para a nossa <a href="{{ URL::to('/') }}">página inicial</a>?
                </p>
            </div>
        </div>    
    </body>
</html>
