<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

</head>

<body style="margin: 0;padding: 0;width: 100%;background-color: #F2F4F6;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
    <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
        <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
            <td class="email-wrapper" align="center" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;width: 100%;margin: 0;padding: 0;background-color: rgb(248, 248, 248)">
                <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
                    <!-- Logo -->
                    <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
                        <td class="email-masthead" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;text-align: center;height: 50px;max-width: 570px">
                            <a class="email-masthead_name" href="{{ url('/') }}" target="_blank" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;color: rgb(94, 94, 94);font-size: 18px;text-decoration: none;height: 20px;padding: 15px">
                                {{ config('app.name') }} - Wachtwoord reset
                            </a>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
                        <td class="email-body" width="100%" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;width: 100%;margin: 0;padding: 0;border-top: 1px solid #EDEFF2;border-bottom: 1px solid #EDEFF2;background-color: #FFF">
                            <table class="email-body_inner" align="center" cellpadding="0" cellspacing="0" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;width: auto;max-width: 570px;margin: 0 auto;padding: 0">
                                <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
                                    <td class="email-body_cell" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;padding: 15px">
                                        <h1 style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;margin-top: 0;color: #2F3133;font-size: 19px;font-weight: bold;text-align: left">
                                            Hallo {{$user->name}},
                                        </h1>

                                        <p style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;margin-top: 0;color: #74787E;font-size: 16px;line-height: 1.5em">
                                            Er is een wachtwoordreset aangevraagd voor het account verbonden aan dit e-mailadres. Klik op de onderstaande knop om je wachtwoord te wijzigen.
                                        </p>

                                        <table class="body_action" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;width: 100%;margin: 30px auto;padding: 0;text-align: center">
                                            <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
                                                <td align="center" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
                                                    <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}" class="button button-primary" target="_blank" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;color: #fff;display: inline-block;width: 200px;min-height: 20px;padding: 10px;border-radius: 3px;font-size: 15px;line-height: 25px;text-align: center;text-decoration: none;-webkit-text-size-adjust: none;border-style: solid;border-width: 1px;background-color: rgb(51, 122, 183);border-color: rgb(18, 43, 64)">
                                                        Wijzig wachtwoord
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>

                                        <p style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;margin-top: 0;color: #74787E;font-size: 16px;line-height: 1.5em">
                                            Mocht bovenstaande knop niet werken klik dan hier of kopiëer deze link naar je browser: 
                                            <a href="{{ $link }}" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;color: #3869D4"> {{ $link }} </a>
                                        </p>

                                        <p style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;margin-top: 0;color: #74787E;font-size: 16px;line-height: 1.5em">
                                            Met vriendelijke groet,<br style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif"/>{{ config('app.name') }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
                        <td style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
                            <table class="email-footer" align="center" cellpadding="0" cellspacing="0" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;width: auto;max-width: 570px;margin: 0 auto;padding: 0;text-align: center">
                                <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif">
                                    <td class="email-footer_cell" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;background-color: rgb(248, 248, 248);padding: 35px;text-align: center">
                                        <p class="paragraph-sub" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;margin-top: 0;color: #74787E;font-size: 12px;line-height: 1.5em">
                                            © {{ date('Y') }}
                                            <a href="{{ url('/') }}" target="_blank" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;color: #3869D4">{{ config('app.name') }}</a>.
                                            All rights reserved.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

