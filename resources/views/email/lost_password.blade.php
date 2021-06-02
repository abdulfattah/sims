<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <style>
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        *[x-apple-data-detectors],
            /* iOS */
        .x-gmail-data-detectors,
            /* Gmail */
        .x-gmail-data-detectors *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        img.g-img + div {
            display: none !important;
        }

        .button-link {
            text-decoration: none !important;
        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            .email-container {
                min-width: 320px !important;
            }
        }

        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            .email-container {
                min-width: 375px !important;
            }
        }

        @media only screen and (min-device-width: 414px) {
            .email-container {
                min-width: 414px !important;
            }
        }
    </style>
    <style>
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }

        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }

            .stack-column-center {
                text-align: center !important;
            }

            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }

            table.center-on-narrow {
                display: inline-block !important;
            }

            .email-container p {
                font-size: 17px !important;
            }
        }
    </style>
</head>

<body width="100%" style="margin: 0; mso-line-height-rule: exactly;">
<div style="width: 100%; background: #eeeeee; text-align: center;position: absolute;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin-top: 10px !important;margin-bottom: 10px !important;"
           class="email-container">
        <tr>
            <td style="background-color:#ffffff;padding: 30px 20px 40px; font-family: sans-serif; font-size: 13px; line-height: 140%; color: #555555; text-align: left;">
                <p style="margin: 0;">
                    <br/>
                    Mr./Mrs. {{ strtoupper($name) }},
                    <br/><br/>
                    We receive your request to reset your password.
                    Please click link below and follow the instruction to set new password for CDN Information Integration System.
                </p>
            </td>
        </tr>
        <tr>
            <td style="background-color:#ffffff;padding: 0 40px 7px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                    <tbody>
                    <tr>
                        <td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td">
                            <a href="{{ $url }}"
                               style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 110%; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;"
                               class="button-a">
                                &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff;">Reset Password</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color:#ffffff;padding: 30px 20px 40px; font-family: sans-serif; font-size: 13px; line-height: 140%; color: #555555; text-align: left;">
                <p style="margin: 0;">
                    <br/><br/>
                    Thank you<br/>
                    CDN Information Integration System
                </p>
            </td>
        </tr>
    </table>
    <table role="presentation" style="background-color:#709f2b" cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
        <tr>
            <td valign="top" align="center">
                <div style="max-width: 600px; margin: auto;" class="email-container">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 10px; text-align: center; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #ffffff;">
                                <p style="margin: 0;">
                                    <strong>CDN Information Integration System</strong>
                                    <br/>
                                    Royal Malaysian Customs Department<br/>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>

</html>
