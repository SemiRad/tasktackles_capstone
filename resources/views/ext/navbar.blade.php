<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" href="{{ asset('css/navbar.css') }}">
	<link rel = "icon" href = "/asset/icon.png" type = "image/x-icon">
	<title>
		TaskTackles
	</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
</head>
<body>
	<input type="checkbox" id="check">
	<nav>
		<div class = "navbar">
		<a href="{{ route('home') }}"><div class="logo"><img src="{{ asset('asset/TT-txt.png') }}"></div></a>
			<ol class = "menuitems">
				<li><a href="login"> Login </a></li>
				<li><a href="signup"> Signup </b></a></li>
			</ol>
		<label for="check" class="fa fa-bars"> </label>
	</div></nav>
</body>
</html>