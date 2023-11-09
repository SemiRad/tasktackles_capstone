@include ('ext.sidenavbar')


<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
	<meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="{{ asset('css/styleChangePW.css') }}" >
    <link rel = "icon" href = "/asset/icon.png" type = "image/x-icon">
  <title>TaskTackles</title>
</head>

<section>
    <body>
 
        <div class="wrapper">
        <div class="errormsg">
            <br><br>
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

        <form action="{{ route('updatePassword', ['id' => $user->id]) }}" method="post">
            <input type="hidden" name="id" value="{{$user->id}}">
            @csrf
           
            
            <h1> Change Password </h1>
            <br>
        
                <div class="row">
                    Current Password: <input type="password" placeholder="Current Password" name="password" >
                </div>
                <span>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>

                <br>
                <div class="row">
                    New Password: <input type="password" placeholder="New Password" name="npassword" >

                </div>
                <br>
                <div class="row">
                    Confirm New Password: <input type="password" placeholder="Confirm New Password" name="password_confirmation" >
             
                </div>
                <span>
                @error('password_confirmation')
                    <div class="alert alert-danger">{{ 'Password does not match' }}</div>
                @enderror
                </span>

                <br>
 
                <div class="row">
                    <input type="submit" value="Save Changes" id="newpw">
                </div>
            </form>
</div>
    

    </body>
</section>
</html>