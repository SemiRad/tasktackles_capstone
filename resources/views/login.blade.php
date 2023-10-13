<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
	<meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="{{ asset('css/styleLogin.css') }}">

  <title>TaskTackles</title>
</head>

<section>
    <body>
    <div class="slideshow-container">
                <img class="lg" src="asset/log2.png" draggable="false">
</div>
        <div class="wrapper">
        <div class="errormsg">
                @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif
            </div>

            <div class="title"><img src="asset/TT-txt.png" alt="TaskTackles"></div>
            <form action="{{ route('signin') }}" method="post">

            @csrf
                <div class="row">
                    <input type="text" placeholder="Username or Email" name="username" value ="{{ old('username')}}">
                </div>
                <div class="row">
                    <input type="password" placeholder="Password"name="password" >
                </div>
                <div class="row">
                    <input type="submit" value="LOG IN" id="login">
                </div>
            </form>
            <div class="forgotpassword">
                <a href="" target="_self" id="forgotpw">Forgot password?</a><br>
            </div>
            <form action="/signup" method ="get">
            <div class="register">
                <p id="text">Don't have an account?<br></p>
                <input type="submit" value="SIGN UP" id="signup">
            </div>
        </form>
    </div>

    </body>
    
    </section>  



</html>