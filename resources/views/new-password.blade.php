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
            <form action="{{ route('resetpassword') }}" method="post">
            <div class="register">
            <p id="text" style= "text-align:left; font-size:x-large;">Reset Password<br></p>
        </div>
            @csrf
            <input type = "text" name ="token" hidden value ="{{$token}}">
            <div class="row">
                    Email: <input type="email" placeholder="Email" name="email" >
            </div>
            <div class="row">
                    New Password: <input type="password" placeholder="New Password" name="password" >
            </div>
            <br>
            <div class="row">
                    Confirm New Password: <input type="password" placeholder="Confirm New Password" name="password_confirmation" >
             </div>
                <div class="row">
                    <input type="submit" value="SAVE PASSWORD" id="login">
                </div>
            </form>

           
            <div class="register">
            <form action="/" method ="get">
                <input type="submit" value="LOG IN" id="signup">
            </form>
           
            </div>
        
    </div>

    </body>
    
    </section>  



</html>