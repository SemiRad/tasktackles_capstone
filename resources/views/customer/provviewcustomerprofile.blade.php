@include ('ext.sidenavbar')

<!DOCTYPE html>
<html>
<head>
	<link rel = "stylesheet" href="{{ asset('css/stylecustViewProvProfile.css') }}">
    <img class="lg" src="../asset/log2.png" draggable="false">
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
                <p class = "r1">Rating: <span style="color:#FFB94E; font-size: 18px; font-weight: bold;">{{ $totalRate }}</span></p>
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

 <main>
    <div class="table-wrapper">
    <div id="ratings-content" class="content">
        <table>
        <tr>
            <th>Booked Service</th>
            <th>Reviewer</th>
            <th>Date & Time</th>
            <th>Rating</th>
            <th>Comment</th>
        </tr>
        @foreach($r as $rate)
        <tr>
            <td>{{ $service->where('id', $services->where('id', $rate->booking_id)->first()->service_id)->first()->service_list_name }}</td>
            <td>{{ $user->where('id', $rate->user_id_reviewer)->first()->username }}</td>
            <td>{{ $rate->created_at }}</td>
            <td>{{ $rate->rating }}</td>
            <td>{{ $rate->comments }}</td>
        </tr>
        @endforeach
    </table>
    <br><br>
    </div>
</div>
           </main>
</body>
</section>
</html>