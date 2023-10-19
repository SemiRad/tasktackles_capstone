@include ('ext.custsidenav')


<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
	<meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="{{ asset('css/styleChangePW.css') }}" >
    <link rel = "icon" href = "/asset/icon.png" type = "image/x-icon">
  <title>TaskTackles</title>
</head>

<section>
    <body>
        <div class ="b">
      
        

        <div class="wrapper">
        <div class="error-message">

            @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
</div>
@php
		$puserID = $service->user_id;
		$user = \App\Models\user::find($puserID);
		@endphp
<div class = "sname">
    <div class="row" id="displayrow">
    <img src="{{ asset('images/' . $service->photo ) }}"><br>
    <ul class="contentLine">
            <li><b>Service</b>{{ $service->service_list_name }}</li>
            <li><b>Provider </b>{{ $user->firstname . ' ' . $user->lastname }}</li>
            <li><b>Category</b>{{ $service->category }}</li>
            <li><b>Description</b>{{ $service->description }}</li>
            <li><b>Price</b>PHP {{ $service->price }}</li>
            <li><b>G-Cash Number</b>{{ $service->gcashnum }}</li>
        </ul>
            <br>
        </div>
        @csrf
        <form action="{{ route('booking-requested', ['id' => $service->id]) }}" method="post">
            <h1> Book a Service Appointment</h1>
            @csrf
            <br>
            <input type="hidden" name="user_id_customer" value="{{ $user->id }}">
        <input type="hidden" name="user_id_provider" value="{{ $service->user_id}}">
        <input type="hidden" name="service_id" value="{{ $service->id }}">
        <input type="hidden" name="service_list_name" value="{{ $service->service_list_name }}"> 
        <input type="hidden" name="gcashnum" value="{{ $service->gcashnum }}"> 
            <div class="row">
            
                Date
                <input type="date" placeholder="Date" id="date" name="date" onblur="formatDate(this)" onfocus="(this.type='date')" 
                     min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"  value="{{ old('date') }}" required>


                    </div>
                    <br>
             <div class="row"> Time: <span id="error-message" style="color: red;"></span>
             <input type="time" placeholder="Aa" name="time" id="timeInput" value="{{ old('time') }}" required disabled>
            </div>
                <br>
                <div class="row">
                    Location: <input type="text" placeholder="Aa" name="location" value="{{ $user->address }}"required>
                </div>
                <br>
                <div class="row">
                    Payment Type:
                    <select name="payment_type" id="dropd" required  >
                        <option value="o" {{ $user->payment_type == 'o' ? 'selected' : '' }}>On Service</option>
                        <option value="g" @if (($service->gcashnum == "n/a") || ($service->gcashnum == "0") || ($service->gcashnum == "null")) disabled  @endif {{ $user->payment_type == 'g' ? 'selected' : '' }}>G-Cash</option>
                    </select>
                </div>
                <br>
               

                <div class="row">
                    <input type="submit" value="Book Service" id="save">
                </div>
            </form>
</div>
</div>



   
    
    </body>
    <script>
    const dateInput = document.getElementById("date");
    const timeInput = document.getElementById("timeInput");
    dateInput.addEventListener("input", function () {
        if (dateInput.value) {
            timeInput.removeAttribute("disabled");
        } else {
            timeInput.setAttribute("disabled", "disabled");
        }
    });
</script>
<style>
    .sname{
        position: relative;
        top:25px;
       color: WHITE;
       margin-left:10px;
    }


    
    </style>
</section>
</html>