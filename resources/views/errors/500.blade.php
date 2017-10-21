<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Desculpe...</title>
        <style>body {font-family: verdana, arial, sans-serif;background-color: #fff;color: #000; }</style>
    </head>

    <body>
        <div>
            <table>
                <tr>
                    <td>
                        <b><font face=sans-serif size=10><font color=#ea4335>{{ config('app.name') }}</font></font></b>
                    </td>
                    <td style="text-align: left; vertical-align: bottom; padding-bottom: 15px; width: 50%">
                        <div style="border-bottom: 1px solid #dfdfdf;">Desculpe...</div>
                    </td>
                </tr>
            </table>
        </div>

        <div style="margin-left: 4em;">
            <h1>Pedimos desculpas...</h1>
            <p>... estamos passando por uma instabilidade em nosso site.</p>
        </div>
        <div style="text-align: center; border-top: 1px solid #dfdfdf;">
            <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
        </div>
    </body>
</html>