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

        <form action="{{ route('updatesn', ['id' => $user->id]) }}" method="post">
            <input type="hidden" name="id" value="{{$user->id}}">
            @csrf
            <br>
            <br>
            
            <h1> Update Service Name </h1>
            <br>
        
                <div class="row">
                    Service Name: <input type="text" placeholder="Set New Service Name" name="service_name" >
                </div>
                <br>
                
                <div class="row">
                    <input type="submit" value="Update Service Name" id="newpw">
                </div>
            </form>
</div>
    
    </body>
</section>
</html>