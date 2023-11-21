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
                <img class="lg" src="{{ asset('asset/log2.png') }}" draggable="false">
</div>
        <div class="wrapper">
        <div class="errormsg">
                @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-success" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                @error('id_img')
                    <div class="alert alert-danger">{{ 'File type unsupported' }}</div>
                @enderror
               
            </div>

            <div class="title"><img src="{{ asset('asset/TT-txt.png') }}" alt="TaskTackles"></div>
            <form action="{{ route('reregister-account') }}" method="post" enctype="multipart/form-data">
            <div class="register">
            <p id="text" style= "text-align:center; font-size:x-large; font-weight: bold;">Re-upload ID Image<br></p>
        </div>
            @csrf
            <input type = "text" name ="token" hidden value ="{{$token}}">
            <div class="row">
                    <input type="email" placeholder="Email" name="email" >
            </div>
        
            <div class="row">
                    <input type="file" name="id_img" style="color: white;">
             </div>
                <div class="row">
                    <input type="submit" value="Reregister" id="login">
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