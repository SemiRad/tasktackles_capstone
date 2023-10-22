@include ('ext.custsidenav')


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
            <form action="#" method="get">
                <div class="send">     
                    <input type="submit" value="Send Message" id="editbtn">
                </div>
            </form>
        
                
            </div>
            </div>

 
            <div class="topbar">
                <ul>
                <div id="stat">
                    <li><a href="#" class="tab-link" data-status="Services">Services</a></li>                  
                </div>
            </ul>

	</div>
</div>
    
    
<main>
        <!-- diri ang foreach -->
        
        @foreach($services as $service)
        @php
        $puserID = $service->user_id;
        $user = \App\Models\user::find($puserID);
        @endphp

        <div class="card">
    <div class="image">
        <img src="{{ asset('images/' . $service->photo) }}" alt="default">
    </div>
    <div class="caption">
        <p class="taskName"><span class="text-{{$service}}">{{$service->service_list_name}}</span></p>
        <p class="cc"><a href = {{route ('view-provider-account-page' ,[ 'id' => $user->id])}}">{{ '@' .$user->username}}</a></p><br>
        <p class="cc" style="height: 100px"><i>Description:</i> <br>{{ strlen($services->description) > 20 ? substr($services->description, 0, 20) . '...' : $services->description }}</p>
        <p class="price"><i>G-Cash No.:</i> {{$service->gcashnum}} <br> Price: <b>{{ 'PHP ' . $service->price }}</b><br></p>
        <form action="{{ route('book-service', ['id' => $service->id]) }}" method="get" id="bookbtn">
            <button class="btnstatcs">Book Service</button>
        </form>
    </div>
</div>
@endforeach
        <!-- end foreach -->
    </main>
    </body>
</section>
</html>