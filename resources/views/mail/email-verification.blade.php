<!DOCTYPE html>
<html style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; background-color: rgb(248, 248, 248);">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body style="width: 100%; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; background-color: #F2F4F6; margin: 0; padding: 0;" bgcolor="#F2F4F6">
    <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
        <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
            <td align="center" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; width: 100%; background-color: rgb(248, 248, 248); margin: 0; padding: 0;" bgcolor="rgb(248, 248, 248)">
                <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                    
                    <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                        <td style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; text-align: center; height: 50px; max-width: 570px;" align="center">
                            <a href="{{ url('/') }}" target="_blank" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; color: rgb(94, 94, 94); font-size: 18px; text-decoration: none; height: 20px; padding: 15px;">
                                {{ config('app.name') }} - Verifieër e-mail
                            </a>
                        </td>
                    </tr>

                    
                    <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                        <td width="100%" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; width: 100%; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #EDEFF2; background-color: #FFF; margin: 0; padding: 0;" bgcolor="#FFF">
                            <table align="center" cellpadding="0" cellspacing="0" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; width: auto; max-width: 570px; margin: 0 auto; padding: 0;">
                                <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                    <td style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding: 15px;">
                                        <h1 style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;" align="left">
                                            Hallo {{ $user->name }},
                                        </h1>

                                        <p style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                            Klik op de onderstaande knop om je e-mailadress te bevestigen
                                        </p>

                                        <table align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; width: 100%; text-align: center; margin: 30px auto; padding: 0;">
                                            <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                                <td align="center" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                                    <a href="{{ url('register/verify/'.$user->email_token) }}" target="_blank" style="width: 100% !important; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; color: #ffffff; display: inline-block; min-height: 20px; border-radius: 3px; font-size: 15px; line-height: 25px; text-align: center; text-decoration: none; -webkit-text-size-adjust: none; background-color: rgb(51, 122, 183); padding: 10px; border: 1px solid rgb(18,43,64);">
                                                        Bevestig
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>

                                        <p style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                            Bedankt
                                        </p>

                                        <p style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                            Met vriendelijke groet,<br style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">{{ config('app.name') }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    
                    <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                        <td style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                            <table align="center" cellpadding="0" cellspacing="0" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; width: auto; max-width: 570px; text-align: center; margin: 0 auto; padding: 0;">
                                <tr style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                    <td style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; text-align: center; background-color: rgb(248, 248, 248); padding: 35px;" align="center" bgcolor="rgb(248, 248, 248)">
                                        <p style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;">
                                            © {{ date('Y') }}
                                            <a href="{{ url('/') }}" target="_blank" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; color: #3869D4;">{{ config('app.name') }}</a>.
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
