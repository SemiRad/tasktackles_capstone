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
                $r = Rate::where('user_id_recipient', $id)->get();
    
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
                  
                    <li><a href="#" class="tab-link" data-status="Ratings">Ratings</a></li>
                    <li><a href="#" class="tab-link" data-status="Feedbacks">Outgoing Feedbacks</a></li>
                    
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

    <div id="feedbacks-content" class="content" style="display: none">
        <table>
        <tr>
            <?php
                $fb = Rate::where('user_id_reviewer', $id)->get();
            ?>
            <th>Booked Service</th>
            <th>Recipient</th>
            <th>Date & Time</th>
            <th>Rating</th>
            <th>Comment</th>
        </tr>
        @foreach($fb as $feedback)
        <tr>
            <td>{{ $services->where('id', $b->where('id', $feedback->booking_id)->first()->service_id)->first()->service_list_name }}</td>
            <td>{{ $users->where('id', $feedback->user_id_recipient)->first()->username }}</td>
            <td>{{ $feedback->created_at }}</td>
            <td>{{ $feedback->rating }}</td>
            <td>{{ $feedback->comments }}</td>
        </tr>
        @endforeach
    </table>
    <BR><BR>
    </div>
    </div>
           </main>
    </body>
</section>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
            // Automatically select "Services" tab when the page opens
            selectTab('Services'); // Call the function to set "Services" as active

            // Add a click event handler to the top bar links
            $('.tab-link').click(function () {
                var status = $(this).data('status');

                // Hide all content sections
                $('.content').hide();

                // Show the content section based on the selected status
                $('#' + status.toLowerCase() + '-content').show();

                // Remove the "active" class from all tabs
                $('.tab-link').removeClass('active');

                // Add the "active" class to the clicked tab
                $(this).addClass('active');
            });
        });
        
        function selectTab(tabName) {
            $('#' + tabName.toLowerCase() + '-content').show();
            $('a[data-status="' + tabName + '"]').addClass('active');
        }</script>