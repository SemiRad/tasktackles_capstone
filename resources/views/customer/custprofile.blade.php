@include ('ext.custsidenav')

<!DOCTYPE html>
<html>
<head>
<meta name = "viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" href="{{ asset('css/stylecustViewProvProfile.css') }}">
    <img class="lg" src="asset/log2.png" draggable="false">
</head>

<section>
    <body>
        <div class="wrapper">
        @csrf
        <?php
            use App\Models\User;
            use App\Models\Service;
            use App\Models\Book;
            use App\Models\Rate;
            $user = array();
            if (Session::has('loginID')) {
                $id = Session::get('loginID');
                $user = User::where('id', '=', $id)->first();
                $users = User::all();
                $b = Book::all();
                $services = Service::all();
                $r = Rate::all();
                $rating = Rate::where('user_id_recipient', $id)->get();
    
                $totalRate = $r->avg('rating');
            }
            ?>
            <div class="parent">
            <div class="left"><img src="{{ asset('images/' . $user->profile_picture ) }}"></div>
            <div class="right">
            <input type="hidden" name="user_id" value="{{$user->id}}">
                <p class = "p1"><b>{{$user->firstname }} {{$user->lastname}}</b></p>
                <p style="color: white;">{{ '@' . $user->username }}</p>
                <p class = "r1">Rating: <span style="color:#FFB94E; font-size: 18px; font-weight: bold;">{{ $totalRate }}</span></p>
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
            <td>{{ $services->where('id', $b->where('id', $rate->booking_id)->first()->service_id)->first()->service_list_name }}</td>
            <td>{{ $users->where('id', $rate->user_id_reviewer)->first()->username }}</td>
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