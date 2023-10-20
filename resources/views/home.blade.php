@include ('ext.navbar')


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
		
	</div>
	<div class="search">
		<li id="bar">
        <input type="text" id="searchInput" placeholder="Search for a service">
    </li>
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