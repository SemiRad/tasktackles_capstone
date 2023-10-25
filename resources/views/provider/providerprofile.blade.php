@include ('ext.sidenavbar')

<!DOCTYPE html>
<html>
<head>
<meta name = "viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" href="{{ asset('css/stylecustViewProvProfile.css') }}">
</head>

    <body>
        @csrf
        <div class="wrapper">
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
				$services = Service::where('user_id', $id)
					->whereIn('status', ['AVAILABLE', 'UNAVAILABLE'])
					->get();
				$r = Rate::where('user_id_recipient', $id)->get();
	
				$totalRate = $r->avg('rating');
	        }
	        ?>
            <div class="parent">
            <div class="left"><img src="{{ asset('images/' . $user->profile_picture ) }}"></div>
            <div class="right">
            <input type="hidden" name="user_id" value="{{$user->id}}">
                <p class = "p1"><b>{{$user->firstname }} {{$user->lastname}}</b></p>
                <p style="color: white;">{{ '@' . $user->username }}</a></p>
                <p class = "r1">Rating: <span style="color:#FFB94E; font-size: 18px; font-weight: bold;">{{ $totalRate }}</span></p>
            </div>

            
            <div class = "butts">
            <form action="{{ route('edit-profile-page') }}" method="get">
                <div class="ed">     
                    <input type="submit" value="Edit Profile" id="editbtn">
                </div>
            </form>

                
            </div>
            </div>

 
            <div class="topbar">
                <ul>
                <div id="stat">
                    <li><a href="#" class="tab-link" data-status="Services">Services</a></li>
                    <li><a href="#" class="tab-link" data-status="Ratings">Ratings</a></li>  
                    <li><a href="#" class="tab-link" data-status="Feedbacks">Outgoing Feedbacks</a></li>
                  
                </div>
            </ul>

	</div>
</div>
<main>
		<input type="hidden" name="user_id" value="{{$user->id}}">
		<!-- Services -->
		<div id="services-content" class="content" style="display: none">
		@foreach($services as $services)
		<div class="card @if($services->status == 'AVAILABLE') available @elseif($services->status == 'UNAVAILABLE') unavailable @else deleted @endif">

			<div class="image">

				<img src="{{ asset('images/' . $services->photo ) }}" alt="service image">
				
			</div>
			
			<div class="caption">
			
				<p class="taskName"><span class="text-{{$services}}">{{$services->service_list_name}}</span>
				<a href="{{ route('update-service', ['id' => $services->id]) }}">
				<svg id="editbtn" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
			
				<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
				
			</svg></a></p>
			<p class="cc"><i>Category:</i> <br>{{ $services->category }}
				<p class="cc" style="height: 100px"><i>Description:</i> <br>
			        {{ strlen($services->description) > 70 ? substr($services->description, 0, 70) . '...' : $services->description }}
			    </p>
				<p class="price">G-Cash No.: {{$services->gcashnum }} <br> Price: {{ 'PHP ' . $services->price }} <br></p>

			
				<div >
        		@if($services->status =="AVAILABLE")
				<form action="{{ route('unavailable', ['id' => $services->id]) }}" method="get"class ="hide">
				@csrf
						<button class="btnstat">Set Unavailable</button>
					</form>
				@endif

				@if($services->status =="UNAVAILABLE")
						<form action="{{ route('available', ['id' => $services->id]) }}" method="get"class ="hide">
						@csrf
						<button class="btnstat">Set Available</button>
						</form>
				@endif

				

				
				<a href="{{ route('delete', ['id' => $services->id]) }}">
				<svg id="delbtn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">	
  				<path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" /><button class="hide" style ="border: 0; width: 5%;"></button>
				</svg> 
			</a>
			</div>
		</div>
	</div>
		@endforeach
	</div>
		<!-- end of services -->
	<div class="table-wrapper">
	<div id="ratings-content" class="content" style="display: none">
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
	</div>
</div>
	</main>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const maxCharacters = 11;
    document.querySelectorAll('[class^="text-"]').forEach((textElement) => {
        if (textElement.textContent.length > maxCharacters) {
            textElement.style.fontSize = '22px';
        }
    });

   
    // Handle search input
        $('#bar input').keyup(function () {
            const searchValue = $(this).val().toLowerCase();
            const status = $('.tab-link.active').data('status');

            // Hide all services
            $('.card').hide();

            if (status === 'available') {
                // Show available services that match the search query
                $('.card.available').each(function () {
                    const serviceName = $(this).find('.taskName').text().toLowerCase();
                    if (serviceName.includes(searchValue)) {
                        $(this).show();
                    }
                });
            } else if (status === 'unavailable') {
                // Show unavailable services that match the search query
                $('.card.unavailable').each(function () {
                    const serviceName = $(this).find('.taskName').text().toLowerCase();
                    if (serviceName.includes(searchValue)) {
                        $(this).show();
                    }
                });
            }
        });

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
        }
</script>
</html>