@include ('ext.custsidenav')


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
                <p class = "r1">Rating:</p>
            </div>
            
            <div class = "butts">
            <form action="/viewConversationCustomer/{{$user->id}}" method="get">
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
                    <li><a href="#" class="tab-link" data-status="Ratings">Ratings</a></li>                          
                </div>
            </ul>

	</div>
    </div>
    
    
<main>
        <!-- diri ang foreach -->
        @foreach($services as $service)
        <div id="services-content" class="content" style="display: flex;">
        <div class="card" style="width: 200vh;">
        @php
        $puserID = $service->user_id;
        $user = \App\Models\user::find($puserID);
        @endphp
        
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
	
	@if ($service->status === 'U')
                    
                    <button class="btnstatcs" style ="background-color: white; color: black; border: 2px solid gray;"disabled>Currently Unavailable</button>
                @else
	<form action="{{ route('book-service', ['id' => $service->id]) }}" method="get" id="bookbtn">
        <button class="btnstatcs">Book Service</button>
    </form>

	@endif
    </div>
    </div>
    </div>
    @endforeach


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
                $services = Service::where('user_id', $service->user_id)
                ->whereIn('status', ['A', 'U'])
                ->get();
                            $r = Rate::where('user_id_recipient', $puserID)->get();
    
                $totalRate = $r->avg('rating');
            }
            ?>
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
    <BR><BR>
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

    $(document).ready(function () {
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
        // Show the content section for the selected tab
        $('#' + tabName.toLowerCase() + '-content').show();
        // Add the "active" class to the corresponding tab
        $('a[data-status="' + tabName + '"]').addClass('active');
    }
</script>
</html>