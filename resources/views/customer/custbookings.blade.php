@include ('ext.custsidenav')


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/bookingProv.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
	.hide{
		display: none;
	}

	</style>
<body>
@csrf
	<div class="search">
	<form>
		<input type="text" id="searchInput" name="searchInput" placeholder="Search for a service">
		</form>
	</div>

	
	<div class="topbar">
	<ul>
    <div id="stat">
        <li><a href="#" class="tab-link active" data-status="all">All</a></li>
        <li><a href="#" class="tab-link" data-status="pending">Pending</a></li>
        <li><a href="#" class="tab-link" data-status="accepted">Accepted</a></li>
        <li><a href="#" class="tab-link" data-status="declined">Declined</a></li>
        <li><a href="#" class="tab-link" data-status="cancelled">Cancelled</a></li>
		<li><a href="#" class="tab-link" data-status="fulfilled">Fulfilled</a></li>
    </div>
</ul>

	</div>


	@foreach ($bookings as $bs)
	@php
		$serviceID = $bs->service_id;
		$service = \App\Models\Service::find($serviceID);
		$puserID = $bs->user_id_provider;
		$user = \App\Models\user::find($puserID);
@endphp

    <div class="card booking-card @if($bs->status == 'Accepted') accepted @elseif($bs->status == 'Declined') declined @elseif($bs->status == 'Cancelled') cancelled @elseif($bs->status == 'Fulfilled') fulfilled @else pending @endif"
     data-date="{{ $bs->date }}" data-time="{{ $bs->time }}">

    <div class="card">
        <div class="col1">
            <label>Provider:</label>
            <a href = {{route ('view-provider-account-page' ,[ 'id' => $user->id])}}"><p>
                    {{ $user->service_name }}
            </p></a>
            <label>Service: </label>
            <p>{{ $service->service_list_name }}</p>
			<label>Payment Type: </label><p> @if($bs->payment_type === "o")  On Service @elseif($bs->payment_type === "g") G-Cash @endif</p>
        </div>

        <div class="col3">
            <label>Date and Time:</label>
            <p>{{ date('l, F j, Y', strtotime($bs->date)) }}, {{ date('h:i A', strtotime($bs->time)) }}
            <span style="color: #F97134"><?php
                date_default_timezone_set('Asia/Manila');
                $eventDateTime = strtotime($bs->date . ' ' . $bs->time);
                $currentTime = time();
                $timeDifference = $eventDateTime - $currentTime;

                $hours = floor($timeDifference / 3600);
                $minutes = floor(($timeDifference % 3600) / 60);

                if($timeDifference < 0){
                    
                } else {
                echo '(' . $hours . ' hours ' . $minutes . ' minutes' . ')';
            }
                ?></span></p> 
            
            <label>Status:</label>
            <p id="accepted" style="color: @if($bs->status =="Pending") grey @elseif ($bs->status =="Accepted") green @elseif ($bs->status =="Declined" || $bs->status =="Cancelled") red @endif;">
                {{ $bs->status }}
            </p>
            <div class="btnstat">
            <form action="{{ route('add-refno', ['id' => $bs->id]) }}" method="post">
                    @csrf
                    <label>Reference Number (G-Cash): </label>
                        <div class ="r">    <input type="number" name="refno" value="{{$bs->refno}}" @if ($bs->payment_type == 'o' || $bs->refno != 0 || $bs->status == "Cancelled") disabled @endif required>
                    </div>
                        <button id="pos" @if($bs->payment_type === "o" || $bs->status == "Declined" || $bs->status == "Cancelled" || $bs->status == "Pending" || $bs->refno != 0) class="hide" @endif>CONFIRM PAYMENT</button>
                        </form>

            <form action="{{ route('cancel', ['id' => $bs->id]) }}" method="get">
                    @csrf
               
               <button id="neg" @if($bs->status == "Fulfilled" || $bs->status == "Declined" || $bs->status =="Cancelled" || $bs->status =="Cancelled" || $hours < 12) class="hide" @endif>CANCEL</button>
            </form>
            </div>
           
        </div>

        <div class="col3">     
        @if($bs->status == "Fulfilled")
       
        @php
            $existingRating = \App\Models\Rate::where('user_id_recipient', $bs->user_id_provider)
                ->where('user_id_reviewer', $bs -> user_id_customer)
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
                <button id="submitRating">SUBMIT</button>
            </div>
        </div>
        @endif
@endif
</div>
</div>
</div>
    </div>
    </div>

@endforeach


	</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
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