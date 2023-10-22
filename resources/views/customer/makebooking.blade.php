@include ('ext.custsidenav')


<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
	<meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="{{ asset('css/styleChangePW.css') }}" >
    <link rel = "icon" href = "/asset/icon.png" type = "image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                <div class="row2" id="tnc">
                <input type="checkbox" id="acceptTerms" name="acceptTerms" style="width: 20px; height: 20px;" required>
                <label for="acceptTerms" style="margin-top: -10px; font-size: 18px;">I accept the <a href="#" style="color: #FFB94E;" data-toggle="modal" data-target="#termsAndConditionsModal">Terms & Conditions</a>
            </label>
            </div>
  <!-- Modal for Terms and Conditions -->
  <div class="modal fade" id="termsAndConditionsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Terms and Conditions</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <b>Terms and Conditions</b><br><br>
                        By using our services or making bookings, you agree to these Terms and Conditions. You have the right to disapprove with our services.
                        <br><br><b>Booking for Services</b><br><br>
                        You may request services through TaskTackles. When you've successfully booked a service, your request will enter a pending status. It's then up to our service providers to review and decide whether to accept or decline your request, taking into account their availability and flexibility.                        <br><br><b>Cancellation Policy</b><br><br>
                        You can cancel a booking terms based on these following terms:
                        <br>(a) The request for service is not approved yet. 
                        <br>(b) If your booking request is approved, you can only cancel the booking if the requested service is scheduled to take place at least 6 hours in the future from the time of your cancellation request.
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
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