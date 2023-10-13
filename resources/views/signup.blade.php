<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" href="{{ asset('css/styleSignup.css') }}">
    <link rel = "icon" href = "/asset/icon.png" type = "image/x-icon">
	<title>TaskTackles</title>
</head>

<section>
    <body>
            <img class="lg" src="asset/log2.png" draggable="false">
        <div class="wrapper">
                <div class="errormsg">
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
            <div class="title"><img src="asset/TT-txt.png" alt="TaskTackles"></div>
            <form method="post" action="{{ route('register') }}">
    @csrf
    <div class="coldiv">
            <div class = "col1">
            
                <div class="row">
                    <input type="text" placeholder="First Name" id="firstname" name="firstname" value ="{{ old('firstname')}}"required>
                </div>
                @error('firstname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('lastname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="row">
                    <input type="text" placeholder="Last Name" id="lastname" name="lastname"  value ="{{ old('lastname')}}"required> 
                </div>
                
                <div class="row">
                    <select name="gender" id="gender" required>
                        <option value="">Select Gender</option>
                        <option value="m">Male</option>
                        <option value="f">Female</option>
                        <option value="nb">Non-binary</option>
                        <option value="none">Prefer not to say</option>
                    </select>
                </div>
                @error('birthday')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="row">
                    <input type="date" placeholder="Birthday" id="birthday" name="birthday" onblur="formatDate(this)" onfocus="(this.type='date')" 
                    max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>"value ="{{ old('birthday')}}" required>
                    </div>
                   
                    @error('contact')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="row">
                    <input type="number" placeholder="Contact Number" id="contact" value ="{{ old('contact')}}"name="contact" maxlength="11" required>
                     </div>
                     
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="row">
                    <input type="text" placeholder="Address" id="address" name="address" value ="{{ old('address')}}"required>
                </div>
                
            </div>
            <div class = "col1">
           
            <div class="row">
                    <input type="text" placeholder="City" id="city" name="city" value ="{{ old('city')}}"required>
                    </div>
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('email_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="row">
                    <input type="email" placeholder="Email" id="email_address" name="email_address" value ="{{ old('email_address')}}"required>
                    </div>
                    
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="row">
                    <input type="text" placeholder="Username" id="username" name="username" value ="{{ old('username')}}"required>
                </div>
               
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="row">
                    <input type="password" placeholder="Password"  id="password" name="password"required>
                </div>
                
                <div class="row">
                    <input type="password" placeholder="Confirm Password" name="password_confirmation" required>
                </div>
                
                </div>
            </div>
                <div class="row2" id="subtn">
                <h1 style="color: #FFB94E; font-size: 60px;">Become a: &nbsp;</h1>

                    </div>
                    <div class="container">
                            <div class="radio-tile-group">
                                <div class="input-container">
                                    <input type="radio" id="Customer" name="usertype" required>
                                    <div class="radio-tile">
                                        <img src="asset/c.png" alt="Customer" style="width: 100%; height: 100%; vertical-align: middle;">
                                    </div>
                                </div>

                                <div class="input-container">
                                    <input type="radio" id="Provider" name="usertype" required>
                                    <div class="radio-tile">
                                        <img src="asset/p.png" alt="Provider" style="width: 100%; height: 100%; vertical-align: middle;">
                                    </div>
                                </div>
                            </div>
                        </div>


<br>
<br>

                <div class="row" id="service-name-row" style="display: none;">
                    <input type="text" placeholder="Service Name" id="service_name" name="service_name">
                </div>
    
                <div class="row" id="id-row" style="display: none;">
                    Proof of Identity: <input type="file" placeholder="ID verification" id="id_img" name="id_img" required>
                </div>
                <br>
                <div class="row" id="subtn">
                    <input type="submit" value="SIGN UP" id="login">
                </div>

                <div class="row" style="color:white; text-align: center;">Already have an account? 
                    <a href="login" style="color: #FF8F2F;"> Click here! </a></div>
                    
                </div>
            </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const contactInput = document.getElementById("contact");

    const maxLength = 11;

    contactInput.addEventListener("input", function () {
        if (contactInput.value.length > maxLength) {
            contactInput.value = contactInput.value.slice(0, maxLength);
        }
    });
});
        document.addEventListener("DOMContentLoaded", function () {
            const userTypeRadios = document.querySelectorAll('input[name="usertype"]');
            const serviceNameInput = document.querySelector('#service-name-row');
            const idVal = document.querySelector('#id-row');
            function handleUserTypeChange() {
                if (userTypeRadios[1].checked) {
                    serviceNameInput.style.display = 'block';
                    idVal.style.display = 'block';
                } else {
                    serviceNameInput.style.display = 'none';
                    idVal.style.display = 'block';
                }
            }

            userTypeRadios.forEach(radio => {
                radio.addEventListener('change', handleUserTypeChange);
            });
        });
      

    @if($message = Session::get('success'))
    <script type="text/javascript">
    $(window).on('load', function() {
        $('#completeRegister').modal('show');
    });
    
    @endif
    </script>
    </body>

    <style>
    
.container {
    display: flex;
    gap: 10px;
    align-items: center;
    justify-content: center;
}

.radio-tile-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    
}

.input-container {
    position: relative;
    height: 10rem;
    width: 10rem;
    margin: .5rem;

}

.input-container input {
    position: absolute;
    height: 100%;
    width: 100%;
    margin: 0;
    cursor: pointer;
    z-index: 2;
    opacity: 0;
}

.input-container .radio-tile {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    border: 2px solid #6F0B5B;
    border-radius: 8px;
}





input:checked+.radio-tile {
    background-color:#A02B68;
    color: #A02B68;
    height: 11rem;
    width: 11rem;
    border: 2px solid White;
}

input:checked+.radio-tile img,
input:checked+.radio-tile label {
    background-color: #A02B68;
    color: #A02B68;
    height: 11rem;
    width: 11rem;
    border: 2px solid white;
}

input:hover+.radio-tile {
    box-shadow: 0 2 12px white;
    background-color: #6F0B5B;
    color: white;
}


input[type="file"]  {
    background-color: white;
    color: #6F0B5B;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
}


    </style>
</section>
</html>
