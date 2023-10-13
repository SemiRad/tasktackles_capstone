@include ('ext.sidenavbar')


<!DOCTYPE html>
<html>
<head>
	<link rel = "stylesheet" href="{{ asset('css/serviceProv.css') }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
@csrf
	<div class="breadcrumbs">
		<!-- BREADCRUMBS
		<ul>
			<li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
			  <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
			</svg></a>
			</li>

			<li class="arrow"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
			<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
			</svg>
			</li>

			<li><a href="#">Services</a></li>

			<li class="arrow"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
			<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
			</svg>
			</li>

			<li><a href="#">Available</a></li>
		</ul>
		-->
	</div>
	  <input type="hidden" name="user_id" value="{{$user->id}}">

	<div class="searchBar">
	<ul>
    <li style="color: white; font-weight: bold; font-size: 23px;">
        <a href="{{ route('service-name') }}">
            {{$user->service_name }}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
        </a>
    </li>

    <li id="bar">
        <input type="text" placeholder="Search for a service">
    </li>

    <div id="stat">
    <li><a href="#" class="tab-link" data-status="available">Available</a></li>
    <li><a href="#" class="tab-link" data-status="unavailable">Unavailable</a></li>
	</div>

</ul>

	</div>

	<main>
		<!-- diri ang foreach -->
		
		<input type="hidden" name="user_id" value="{{$user->id}}">
	
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
				
				<p class="cc" style="height: 100px">{{$services->description }}</p>
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
  				<path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" /><button class="hide" style ="border: 0; width: 5%;" ></button>
				</svg> 
			</a>


		


			</div>
		</div>
	</div>
		@endforeach
		<!-- end foreach -->
	

	<div class="addcard">
		<form action="add-service" method="GET" class="hide">
		<button>
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  		<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
		</svg>
		</form>
	</button>
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

    $(document).ready(function () {
    	$('.card').hide();
        $('.card.available').show();
        $('.tab-link[data-status="available"]').addClass('active');

        $('.tab-link').click(function (e) {
            e.preventDefault();
            const status = $(this).data('status');
            
            $('.card').hide();

            $('.tab-link').removeClass('active');

            if (status === 'available') {
                $('.available').show();
                $(this).addClass('active');
            } else if (status === 'unavailable') {
                $('.unavailable').show();
                $(this).addClass('active');
            }
        });
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
</script>


</html>