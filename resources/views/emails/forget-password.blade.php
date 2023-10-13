<head>
    <style>
    .button {
        -webkit-appearance: button;
        -moz-appearance: button;
        appearance: button;
        -webkit-text-size-adjust: none;
        border-radius: 4px;
        color: #fff;
        display: inline-block;
        overflow: hidden;
        text-decoration: none;
        background-color: #737373;
        padding: 5px;
        text-align: center;
    }
    </style>
</head>


Hello, <br><br>
You have requested to Reset your <b style = "color:#470047;">TaskTackles</b> account password. Click on the button below to reset your password.

<a href="{{route('reset-password', $token)}}">Reset Password</a>


