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
    <p class="cc"><a href="{{ route('view-provider-account-page', ['id' => $user->id]) }}">{{ $user->service_name }}</a></p><br>
    <p class="cc"><i>Category:</i> <br>{{ $service->category }}
    </p>
	<p class="cc" style="height: 100px"><i>Description:</i> <br>
        {{ strlen($service->description) > 70 ? substr($service->description, 0, 70) . '...' : $service->description }}
    </p>
    <p class="cc"><i>G-Cash No.:</i> {{$service->gcashnum}} </p>
	<p class="cc"><i>Price.:</i> <b>{{ 'PHP ' . $service->price }}</b> </p>
	
	@if ($service->status === 'UNAVAILABLE')
                    
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