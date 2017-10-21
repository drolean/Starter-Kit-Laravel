<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Error 429 - Too Many Attempts</title>

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
                <h1>Server Error: 429 (Too Many Attempts)</h1>
                <hr>
                <h3>O que isto significa?</h3>
                <p>
                    Você fez muitas solicitações para a mesma página, e agora você terá que esperar por <strong>{{ (isset($retryAfter)) ? $retryAfter : '1 minuto' }}</strong> antes de acessar essa página novamente.
                </p>
            </div>
        </div>    
    </body>
</html>
