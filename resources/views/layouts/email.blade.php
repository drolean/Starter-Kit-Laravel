<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ config('app.name') }}</title>
    <style type="text/css">
    /* Template styling */
    body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;width:100%;max-width:100%;font-size:16px;line-height:24px; color: #74787E;}
    table{width:100%;margin:0 auto}
    h1,h2,h3,h4{color:#cb0003;margin-bottom:12px;line-height:26px}
    p,ul,ul li{margin-top: 0;color: #74787E;font-size: 16px;line-height: 1.5em;}
    ul{margin-bottom:24px}
    ul li{margin-bottom:8px}
    p.mini{font-size:12px;line-height:18px;color:#ABAFB4}
    p.message{font-size:16px;line-height:20px;margin-bottom:4px}
    hr{margin:1rem 0;width:100%;border:none;border-bottom:1px solid #ECECEC}
    a,a:link,a:visited,a:active,a:hover{font-weight:700;color:#439fe0;text-decoration:none;word-break:break-word}
    a:active,a:hover{text-decoration:underline}
    .time{font-size:11px;color:#ABAFB4;padding-right:6px}
    .emoji{vertical-align:bottom}
    .avatar{border-radius:2px}
    #footer p{margin-top:16px;font-size:12px}
    dt {font-weight: 700;font-size: 14px;line-height: 40px;}

    /* Client-specific Styles */
    #outlook a {padding:0;}
    body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0 auto; padding:0;}
    .ExternalClass {width:100%;}
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
    #backgroundTable {margin:0; padding:0; width:100%; line-height: 100% !important;}

    /* Some sensible defaults for images Bring inline: Yes. */
    img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
    a img {border:none;}
    .image_fix {display:block;}

    /* Outlook 07, 10 Padding issue fix Bring inline: No.*/
    table td {border-collapse: collapse;}

    /* Fix spacing around Outlook 07, 10 tables Bring inline: Yes */
    table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }

    /* Mobile */
    @media only screen and (max-device-width: 480px) {
        /* Part one of controlling phone number linking for mobile. */
        a[href^="tel"], a[href^="sms"] {text-decoration: none;color: blue;pointer-events: none;cursor: default;}
        .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {text-decoration: default;color: orange !important;pointer-events: auto;cursor: default;}
    }

    /* Not all email clients will obey these, but the important ones will */
    @media only screen and (max-width: 480px) {
        .card {padding: 1rem 0.75rem !important;}
        .link_option {font-size: 14px;}
        hr {margin: 2rem -0.75rem !important;padding-right: 1.5rem !important;}
    }

    /* More Specific Targeting */
    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        a[href^="tel"], a[href^="sms"] {text-decoration: none;color: blue; pointer-events: none;cursor: default;}
        .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {text-decoration: default;color: orange !important;pointer-events: auto;cursor: default;}
    }

    /* iPhone Retina */
    @media only screen and (-webkit-min-device-pixel-ratio: 2) and (max-device-width: 640px)  {
        #footer p {font-size: 9px;}
    }

    /* Android targeting */
    @media only screen and (-webkit-device-pixel-ratio:.75){
        img {max-width: 100%;height: auto;}
    }
    @media only screen and (-webkit-device-pixel-ratio:1){
        img {max-width: 100%;height: auto;}
    }
    @media only screen and (-webkit-device-pixel-ratio:1.5){
        img {max-width: 100%;height: auto;}
    }
    /* Galaxy Nexus */
    @media only screen and (min-device-width : 720px) and (max-device-width : 1280px) {
        img {max-width: 100%;height: auto;}
        body {font-size: 16px;}
    }
    </style>
</head>
<body>

<table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
    <tr>
        <td valign="top">
            <table id="header" width="100%" cellpadding="0" cellspacing="0" border="0" style="background: #F9F9F9;">
                <tr>
                    <td valign="bottom" style="padding: 20px 16px 12px;">
                        <div style="max-width: 600px; margin: 0 auto; text-align: center;">
                            <a href="{{ URL::to('/') }}" target="_blank" style="text-decoration: none;">
                            @if(Auth::user())
                                <img src="{{ asset(Auth::user()->Companie->logo) }}" alt="{{ config('app.name') }}" style="margin-left: -1.5rem;width:100%;" />
                            @else
                                <h3>{{ config('app.name') }}</h3>
                            @endif
                            </a>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Email Body -->
    @yield('conteudo')

    <tr>
        <td>
            <table id="footer" width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="background:#F9F9F9; color: #989EA6;">
                <tr>
                    <td valign="top" align="center">
                        <div style="max-width: 600px; margin: 0 auto;">
                            <p class="footer_address" style="margin-top: 16px; font-size: 12px; line-height: 20px;">
                                © {{ date('Y') }}  <a href="{{ URL::to('/') }}" target="_blank" style="font-weight: bold; color: #439fe0;">{{ config('app.name') }}</a> &nbsp;&bull;&nbsp;
                                <a href="{{ URL::to('/') }}" target="_blank" style="font-weight: bold; color: #439fe0;">{{ URL::to('/') }}</a><br />
                            </p>
                            <hr>
                            <p class="footer_address" style="margin-top: 16px; font-size: 12px; line-height: 20px;">
                                Este email foi enviado para <a href="mailto:{{ $email }}" target="_blank" style="font-weight: bold; color: #439fe0;">{{ $email }}</a><br />
                                Este é um e-mail gerado automaticamente. Se você não solicitou este serviço, você pode simplesmente apagar este e-mail.
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>