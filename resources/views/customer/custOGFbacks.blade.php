@include ('ext.custsidenav')



<!DOCTYPE html>
<html>
<head>
	<link rel = "stylesheet" href="{{ asset('css/bookingProv.css') }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<style>
	.hide{
		display: none;
	}

	</style>
<body>
@csrf
	<div class="search">
	<form action="#" method = "get">
		<input type="text" name="search" placeholder="Search for a booked service">
		</form>
	</div>

	

	@foreach ($bookings as $bs)
	@php
		$serviceID = $bs->service_id;
		$service = \App\Models\Service::find($serviceID);
		$puserID = $bs->user_id_provider;
		$user = \App\Models\user::find($puserID);
@endphp
<div class="card">
    <div class="card">
        <div class="col1">
            <label>Provider:</label>
            <a href = {{route ('view-provider-account-page' ,[ 'id' => $user->id])}}"><p>
                    {{ $user->service_name }}
            </p></a>
            <label>Service:</label>
            <p>{{ $service->service_list_name }}</p>
            <label>Rating</label>
            <p>
                <input type="text" placeholder="0" name="payment_type" @if($bs->payment_type === "o")  DISABLED value="On Service" @elseif($bs->payment_type === "g") disabled value="G-Cash" @endif required readonly>
            </p>
            <label>Comment:</label>
			<input type="number" placeholder="0" name="refno" @if($bs->payment_type === "o") class="hide" @endif required>
        </div>

        <div class="col3">
            <div class="btnstat"> 
                <form action ="#" method ="post">
                <button id="pos">Submit Review</button>
</form>
            </div>
        </div>
    </div>
    </div>

@endforeach


	</div>
</body>
</html>