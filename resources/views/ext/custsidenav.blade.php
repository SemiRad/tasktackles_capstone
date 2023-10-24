<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" href="{{ asset('css/custsidenavbar.css') }}">
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
		<a href="{{ route('customer-home') }}"><div class="logo"><img src="{{ asset('asset/TT-txt.png') }}"></div></a>
			<ol class = "menuitems">
                <li><a href="{{ route('customer-home') }}"> Home </a></li>
				<li><a href="{{ route('services') }}"> Services </a></li>
				<li><a href="{{ route('bookings') }}">Bookings</a></li>
				<div class="dropdown">
					<button class="accnt">Account 
					<i class="fa fa-caret-down" style="margin-left: 10px; margin-top: 5px;"></i>
					</button>
					<div class="accountitems">
							<li><a href="{{ route('customer-account-page') }}"> Profile Page </a></li>
							<li><a href="{{ route('cChangepw') }}"> Change Password </a></li>
                            <br>
							<li><a href="{{ route('custmsg') }}"> Messages </a></li>
							<br>
							<li><a href="/logout"> Sign Out </a></li>
							</div>
 				 </div> 

				
			</ol>
		<label for="check" class="fa fa-bars"> </label>
	</div>
</nav>
</body>
</html>