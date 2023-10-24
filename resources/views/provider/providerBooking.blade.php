@include ('ext.sidenavbar')


<!DOCTYPE html>
<html>
<head>   
    <link rel = "stylesheet" href="{{ asset('css/bookingProv.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
@csrf
	<div class="search">
		<input type="text" name="searchInput" id="searchInput" placeholder="Search for a booked service">
	</div>

	<div class="topbar">
	<ul>
    <div id="stat">
        <li><a href="#" class="tab-link" data-status="all">All</a></li>
        <li><a href="#" class="tab-link" data-status="Pending">Pending</a></li>
        <li><a href="#" class="tab-link" data-status="Accepted">Accepted</a></li>
        <li><a href="#" class="tab-link" data-status="Declined">Declined</a></li>
        <li><a href="#" class="tab-link" data-status="Cancelled">Cancelled</a></li>
		<li><a href="#" class="tab-link" data-status="Fulfilled">Fulfilled</a></li>
    </div>
</ul>

	</div>

	@foreach ($bookings as $bs)
	@php
		$serviceID = $bs->service_id;
		$service = \App\Models\Service::find($serviceID);
		$puserID = $bs->user_id_customer;
		$user = \App\Models\user::find($puserID);
@endphp
<div class="card booking-card @if($bs->status == 'Accepted') accepted @elseif($bs->status == 'Declined') declined @elseif($bs->status == 'Cancelled') 
cancelled @elseif($bs->status == 'Fulfilled') fulfilled @else pending @endif">

	<div class="card">
		<div class="col1">
		<label>Service:</label><p>{{$service->service_list_name}}</p>
		<label>Customer:</label>  <a href = {{route ('view-customer-account-page' ,[ 'id' => $user->id])}}"><p>{{$user->firstname }} {{$user->lastname}}</p></a>
		<label>Location:</label><p>{{$bs->location}}</p>
		<label>Date and Time:</label>
<p>
    {{ date('l, F j, Y', strtotime($bs->date)) }}, {{ date('h:i A', strtotime($bs->time)) }}
</p>
		</div>

		<div class="col2">
		

		<label>To receive:</label><p>PHP {{$service->price }}</p>
		<label>Payment Type:</label><p>@if($bs->payment_type === "o")  On Service @elseif($bs->payment_type === "g") G-Cash @endif </p>
		<label>Payment Status:</label><p>{{$bs->payment_status }}</p>
		<label>Reference No.:</label><p>{{$bs->refno }}</p>
		</div>

		<div class="col3">
    <label>Status:</label>
    <p style="color:
        @if($bs->status =="Pending") grey
        @elseif($bs->status =="Accepted") green
        @elseif($bs->status =="Declined") red
        @elseif($bs->status =="Fulfilled") green 
        @endif;">
        {{ $bs->status }}
    </p>
    <div class="btnstat">
        @if($bs->status =="Pending")
            <form action="{{ route('accepted', ['id' => $bs->id]) }}" method="get">
                <button id="pos">ACCEPT</button>
            </form>
            <form action="{{ route('decline', ['id' => $bs->id]) }}" method="get">
                <button id="neg">DECLINE</button>
            </form>
     	@elseif($bs->status =="Accepted")
            <form action="{{ route('fulfill', ['id' => $bs->id]) }}" method="get">
                <button id="pos">FULFILLED</button>
            </form>
        @endif
       
        @if($bs->status == "Fulfilled")
            @if($bs->payment_status != "Paid")
                <form action="{{ route('paid', ['id' => $bs->id]) }}" method="get">
                    <button id="pos">PAID</button>
                </form>
            @endif
       
        @php
            $existingRating = \App\Models\Rate::where('user_id_recipient', $bs->user_id_customer)
                ->where('user_id_reviewer', $bs -> user_id_provider)
                ->where('booking_id', $bs->id)
                ->first();
        @endphp
        @if (!$existingRating)
                <button class="rate" data-modal-id="rateModal_{{ $bs->id }}">RATE</button>
                <div class="modal" id="rateModal_{{ $bs->id }}">
                <div class="ratesheet">
            <form action="{{ route('review-customer', ['id' => $bs->id]) }}" method="post">
                <textarea name="comments" id="comments" rows="4" cols="60"></textarea>
                @csrf
            <input type="hidden" name="user_id_reviewer" value="{{ $user->id }}">
            <input type="hidden" name="user_id_recipient" value="{{ $bs->user_id_customer}}">
            <input type="hidden" name="booking_id" value="{{ $bs->id }}">
        </div>
            <div class="rating-box">
            <div class="stars">
                <div class="stars-only">
                <input type="radio" name="rating" value="1" id="star1" required >
                <label for="star1"><i class="fa-solid fa-star"></i></label>

                <input type="radio" name="rating" value="2" id="star2">
                <label for="star2"><i class="fa-solid fa-star"></i></label>

                <input type="radio" name="rating" value="3" id="star3">
                <label for="star3"><i class="fa-solid fa-star"></i></label>

                <input type="radio" name="rating" value="4" id="star4">
                <label for="star4"><i class="fa-solid fa-star"></i></label>

                <input type="radio" name="rating" value="5" id="star5">
                <label for="star5"><i class="fa-solid fa-star"></i></label>
                </div>
                <button id="submitRating">SUBMIT</button>
            </div>
        </div>
    </div>
        @endif
@endif
</div>
</div>
</div>
</div>
        @endforeach
		</div>
		</div>

		

	</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        function filterBookingCards() {
            var searchText = $("#searchInput").val().toLowerCase();
            var status = $(".tab-link.active").data("status").toLowerCase();

            $(".booking-card").hide();

            if (status === "all") {
                $(".booking-card").each(function () {
                    var cardText = $(this).text().toLowerCase();
                    if (cardText.includes(searchText)) {
                        $(this).show();
                    }
                });
            } else {
                $(".booking-card." + status).each(function () {
                    var cardText = $(this).text().toLowerCase();
                    if (cardText.includes(searchText)) {
                        $(this).show();
                    }
                });
            }
        }

        $("#searchInput").keyup(function () {
            filterBookingCards();
        });

        $(".tab-link[data-status='all']").click();

        $(".tab-link").click(function () {
            var status = $(this).data("status");
            $(".tab-link").removeClass("active");
            $(this).addClass("active");
            filterBookingCards();
        });

    function handleRating(ratesheet) {
        const stars = ratesheet.querySelectorAll(".stars i");
        stars.forEach((star, index1) => {
            star.addEventListener("click", () => {
                stars.forEach((star, index2) => {
                    index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
                });
            });
        });
    }

    const ratesheets = document.querySelectorAll(".rating-box");
        ratesheets.forEach((ratesheet) => {
        handleRating(ratesheet);
    });

    $(document).ready(function() {
    // Hide all rateModals initially
    $('.modal').hide();

    // Show the modal when a "RATE" button is clicked
    $('.rate').on('click', function() {
        var modalId = $(this).data('modal-id');
        $('#' + modalId).show();
        $(this).hide();
    });
});
</script>


</html>