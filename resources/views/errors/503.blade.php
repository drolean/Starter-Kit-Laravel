<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Volto logo</title>

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

            .title {
                font-size: 84px;
                text-align: center;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .links  {
                font-size: 12px;
                letter-spacing: .1rem;
            }            
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Volto logo
                </div>            

                <div class="links">
                    <h1>{{ json_decode(file_get_contents(storage_path('framework/down')), true)['message'] }}</h1>
                    <h2>Pedimos desculpas...</h2>
                    <h4>... estamos passando por uma instabilidade em nosso site.</h4>
                </div>
            </div>
        </div>    
    </body>
</html>
