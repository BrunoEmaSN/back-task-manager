<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <title>
        Forgot Password
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        .box {
            background: #fff;
            margin: 0px auto;
            max-width: 600px;
            margin-top: 20px;
            border: #dddddd solid 1px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .title {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            color: #3A3A3A;
            text-transform: uppercase;
            padding-top: 20px;
        }

        .description {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 18px;
            font-weight: 400;
            line-height: 1;
            text-align: center;
            color: #3A3A3A;
            padding-left: 25px;
            padding-right: 25px;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .flex {
            display: flex;
        }

        .center {
            margin: auto;
        }

        .button_container {
            width: 150px;
            text-align: center;
            border: none;
            border-radius: 3px;
            cursor: auto;
            padding: 15px 25px;
            background: #008A90;
        }

        .button_text {
            color: #ffffff;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 15px;
            font-weight: normal;
            line-height: 120%;
            Margin: 0;
            text-decoration: none;
            text-transform: none;
        }

        .note {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 16px;
            line-height: 20px;
            text-align: center;
            color: #ACA9BB;
            padding-top: 20px;
            padding-left: 25px;
            padding-right: 25px;
            padding-bottom: 20px;
        }

        .made-by {
            margin-top: 20px;
            padding: 10px;
            clear: left;
            text-align: center;
            font-size: 10px;
            font-family: arial;
            color: #3A3A3A;
        }

        @media only screen and (max-width:480px) {
            @-ms-viewport {
                width: 320px;
            }

            @viewport {
                width: 320px;
            }
        }

        @media only screen and (min-width:480px) {
            .mj-column-per-100 {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class ="title">
        Reset your password
    </div>
    <div class="box">
        <div class="description">
            Hello,
            We’ve received a request to reset the password for the account
            associated with {{ $email }}. No changes have been made to your
            account yet.
            You can reset your password by clicking the link below:
        </div>
        <div class="flex">
            <div class="center">
                <div class="button_container">
                    <a href="{{ $token }}" class="button_text">
                        Reset Password
                    </a>
                </div>
            </div>
        </div>
        <div class="note">
            Just so you know: You have 20 minutes to pick your password. After that,
            you'll have to ask for a new one.
        </div>
    </div>

    <div class="made-by">
        Task Manager, Posadas, Misiones, Argentina
    </div>
</body>

</html>
