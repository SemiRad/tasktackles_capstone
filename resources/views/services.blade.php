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

    <div class="filter">
            <label for="selectedCategory">Filter by Category:</label>
            <select id="selectedCategory" name="category">
            <option value="">Choose...</a></option>
                <option value="all">All</a>
                </option>
                <option value="Kitchen">Kitchen</option>
                <option value="LivingRoom">Living Room</option>
                <option value="Bedroom">Bedroom</option>
                <option value="Bathroom">Bathroom</option>
                <option value="Plumbing">Plumbing</option>
                <option value="Electricity">Electricity</option>
                <option value="Yard">Yard/Lawn</option>
                <option value="Others">Others</option>
            </select>
            
        </div>
    </div>
	

	<main>
		
		
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
    <p class="cc"><a href="{{ route('view-provider-account-page', ['id' => $user->id]) }}">{{ '@' . $user->service_name }}</a></p><br>
    <p class="category"><i>Category:</i> <br>{{ $service->category }}
    </p>
	<p class="cc" style="height: 100px"><i>Description:</i> <br>
        {{ strlen($service->description) > 70 ? substr($service->description, 0, 70) . '...' : $service->description }}
    </p>
    <p class="cc"><i>G-Cash No.:</i> {{$service->gcashnum}} </p>
	<p class="cc"><i>Price.:</i> <b>{{ 'PHP ' . $service->price }}</b> </p>
	
	@if ($service->status === 'U')
                    
                    <button class="btnstatcs" style ="background-color: white; color: black; border: 2px solid gray;"disabled>Currently Unavailable</button>
                @else
	<form action="{{ route('book-service', ['id' => $service->id]) }}" method="get" id="bookbtn">
        <button class="btnstatcs">Book Service</button>
    </form>
	@endif
</div>
</div>
@endforeach
		<!-- end foreach -->
	</main>

	
		</form>
		</div>
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
            const categorySelect = $('#selectedCategory');

            function filterServices() {
            const searchTerm = searchInput.val().toLowerCase();
            const selectedCategory = categorySelect.val().toLowerCase();

            serviceCards.each(function () {
                const card = $(this);
                const serviceName = card.find('.taskName').text().toLowerCase();
                const serviceDescription = card.find('.cc').text().toLowerCase();
                const serviceCategory = card.find('.category').text().toLowerCase();

                const matchesSearch = serviceName.includes(searchTerm) || serviceDescription.includes(searchTerm);
                const matchesCategory = selectedCategory === 'all' || serviceCategory.includes(selectedCategory);

                if (matchesSearch && matchesCategory) {
                    card.show();
                } else {
                    card.hide();
                }
            });
}

            searchInput.on('input', filterServices);
            categorySelect.on('change', filterServices);

                categorySelect.on('change', function () {
        const selectedCategory = categorySelect.val();

        if (selectedCategory === 'all') {
            window.location.href = "{{ route('service') }}";
        } else {
            // Generate the URL based on the selected category
            const url = "{{ route('search') }}?category=" + encodeURIComponent(selectedCategory);

            // Navigate to the generated URL
            window.location.href = url;
        }
    });


            // Retrieve the selected category value from the query parameter in the URL
            const urlParams = new URLSearchParams(window.location.search);
            const selectedCategory = urlParams.get('category');

            // Set the selected category in the dropdown
            categorySelect.val(selectedCategory);
        });
    </script>
</body>
</html>