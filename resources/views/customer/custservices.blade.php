@include ('ext.custsidenav')


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
	<div class="search">
		<li id="bar">
        <input type="text" id="searchInput" placeholder="Search for a service">
    </li>
	</div>
	  <input type="hidden" name="user_id" value="{{$user->id}}">
<!--
	<div class="searchBar">
		<ul>
			<li><a href="#" id="sName">{{$user->service_name }}</a><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
			<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
			</svg>
			</li>

			<li id="bar">
			<input type="text" placeholder="Search for a service">
			</li>

			<div id="stat">
			<li><a href="#" class="active">Available</a></li>
			<li><a href="#">Unavailable</a></li>
		</div>
		</ul>
	</div>-->

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
    <p class="cc"><a href="{{ route('view-provider-account-page', ['id' => $user->id]) }}">{{ '@' . $user->username }}</a></p><br>
    <p class="cc" style="height: 100px"><i>Description:</i> <br>
        {{ strlen($service->description) > 70 ? substr($service->description, 0, 70) . '...' : $service->description }}
    </p>
    <p class="price"><i>G-Cash No.:</i> {{$service->gcashnum}} <br> Price: <b>{{ 'PHP ' . $service->price }}</b><br></p>
    <form action="{{ route('book-service', ['id' => $service->id]) }}" method="get" id="bookbtn">
        <button class="btnstatcs">Book Service</button>
    </form>
</div>
</div>
@endforeach
		<!-- end foreach -->
	</main>

	
		</form>
		</div>
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
        const searchInput = $('#searchInput');
        const serviceCards = $('.card');

        searchInput.on('input', function () {
            const searchTerm = searchInput.val().toLowerCase();

            serviceCards.each(function () {
                const card = $(this);
                const serviceName = card.find('.taskName').text().toLowerCase();
                const serviceDescription = card.find('.cc').text().toLowerCase();

                if (serviceName.includes(searchTerm) || serviceDescription.includes(searchTerm)) {
                    card.show();
                } else {
                    card.hide();
                }
            });
        });
    });
</script>
</html>