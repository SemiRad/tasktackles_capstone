@include ('ext.sidenavbar')



<!DOCTYPE html>
<html>
<head>
	<link rel = "stylesheet" href="{{ asset('css/stylecustViewProvProfile.css') }}">
</head>

<section>
    <body>
        <div class="wrapper">
     
            <div class="parent">
            <div class="left"><img src="{{ asset('images/' . $user->profile_picture ) }}"></div>
            <div class="right">
            <input type="hidden" name="user_id" value="{{$user->id}}">
                <p class = "p1"><b>{{$user->firstname }} {{$user->lastname}}</b></p>
                <p style="color: white;">{{ '@' . $user->username }}</p>
                <p class = "r1">Rating:</p>
            </div>
            
            <div class = "butts">
            <form action="/viewConversation/{{$user->id}}" method="get">
                <div class="send">     
                    <input type="submit" value="Send Message" id="editbtn">
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
</div>
</body>
</section>
</html>