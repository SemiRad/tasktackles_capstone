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
            <form action="{{route('forgetpassword')}}" method="post">
            <div class="register">
                <h1 style="color: #F97134;">ACCOUNT RECOVERY</h1>
            <p id="text" style= "text-align:left; font-size:small;">Enter your email address and we will send you a link to reset your password.<br></p>
        </div>
            @csrf
            
                <div class="row">
                    <input type="email" placeholder="Enter Email Address" name="email">
                </div>
             
                <div class="row">
                    <input type="submit" value="Send Link" id="login">
                </div>
            </form>

           

            <div class="forgotpassword">
                <a href="/login" target="_self" id="forgotpw">Go Back</a><br>
            </div>
           
           
           
        <br>
    </div>

    </body>
    
    </section>  



</html>