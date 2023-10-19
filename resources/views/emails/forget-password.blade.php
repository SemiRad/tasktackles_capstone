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

    .rep #rp{
        background-color:#470047;
	color: white;
	font-weight: 500;
	font-size: 22px;
	border: 0;
	border-radius: 32px;
	cursor: pointer;
	width: 50%;}

        .wrapper .rep{
	color: white;
	text-align: center;
	margin-top: -50px;
}

.wrapper .rep #rp:hover{
	background-color:#FF8F2F;
	color: white;
}

    
    </style>
</head>


Hello, <br><br>
You have requested to Reset your <b style = "color:#470047;">TaskTackles</b> account password. Click on the button below to reset your password.


<br>
<div class ="rep">
            <form action="{{route('reset-password', $token)}}" method ="get">
                <input type="submit" value="Reset Password" id="rp">
            </form>
           
</div>   



