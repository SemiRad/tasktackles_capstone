@include ('ext.custsidenav')

<!DOCTYPE html>
<html>
<head>
<meta name = "viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" href="{{ asset('css/stylecustViewProvProfile.css') }}">
</head>

<section>
    <body>
        <div class="wrapper">
        @csrf
            <div class="parent">
            <div class="left"><img src="{{ asset('images/' . $user->profile_picture ) }}"></div>
            <div class="right">
            <input type="hidden" name="user_id" value="{{$user->id}}">
                <p class = "p1"><b>{{$user->firstname }} {{$user->lastname}}</b></p>
                <p style="color: white;">{{ '@' . $user->username }}</p>
                <p class = "r1">Rating:</p>
            </div>
            
            <div class = "butts">
            <form action="{{ route('edit-profile-customer') }}" method="get">
                <div class="ed">     
                    <input type="submit" value="Edit Profile" id="editbtn">
                </div>
            </form>

                
            </div>
            </div>

 
            <div class="topbar">
                <ul>
                <div id="stat">
                  
                    <li><a href="#" class="tab-link" data-status="Feedbacks">Feedbacks</a></li>
                  
                </div>
            </ul>

	</div>
    


    </body>
</section>
</html>