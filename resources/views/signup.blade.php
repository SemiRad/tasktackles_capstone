<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" href="{{ asset('css/styleSignup.css') }}">
    <link rel = "icon" href = "/asset/icon.png" type = "image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/ph-city.js') }}"></script>
	<title>TaskTackles</title>
    <script>    
    window.onload = function() {    
        var $ = new City();
        $.showProvinces("#province");
        $.showCities("#city");
        console.log($.getProvinces());
        console.log($.getAllCities());
        console.log($.getCities("Batangas"));        
}
</script>
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
            <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
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

                <div class="row">
                    <input type="date" placeholder="Birthday" id="birthday" name="birthday" onblur="formatDate(this)" onfocus="(this.type='date')" 
                    max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>"value ="{{ old('birthday')}}" required>
                    </div>
                    @error('birthday')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                <label>Contact Number:</label>
<input type="text" placeholder="Aa" id="contact" name="contact" value="09{{old('contact')}}" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                     </div>
                     @error('contact')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class = "col1">

                <!--REGION PROVINCE CITY SELECTOR-->
            <div class="row">
                <select id="province" name="province" required>
                </select>
            </div>

            <div class="row">
                <select id="city" name="city" required>    
                </select>
            </div>

                <!-- END OF LOCATION SELECTOR -->

            <!--<div class="row">
                    <input type="text" placeholder="City" id="city" name="city" value ="{{ old('city')}}"required>
                    </div>
                    @error('city')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror-->
                    <div class="row">
                    <input type="text" placeholder="Address" id="address" name="address" value ="{{ old('address')}}"required>
                </div>
                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    @error('email_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                <div class="row">
                    <input type="email" placeholder="Email" id="email_address" name="email_address" value ="{{ old('email_address')}}"required>
                    </div>
                   
                <div class="row">
                    <input type="text" placeholder="Username" id="username" name="username" value ="{{ old('username')}}"required>
                </div>
                @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <input type="password" placeholder="Password"  id="password" name="password"required>
                </div>
                <p style ="font-size: small; color: gray; text-align:center;"> Your password must be at least 8 characters long. </p>
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
                                    <input type="radio" id="Customer" name="usertype" value="Customer"required>
                                    <div class="radio-tile">
                                        <img src="asset/c.png" alt="Customer" style="width: 100%; height: 100%; vertical-align: middle;">
                                    </div>
                                </div>

                                <div class="input-container">
                                    <input type="radio" id="Provider" name="usertype" value="Provider"required>
                                    <div class="radio-tile">
                                        <img src="asset/p.png" alt="Provider" style="width: 100%; height: 100%; vertical-align: middle;">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <br>
                        <br>

                <div class="row" id="service-name-row" style="display: none;">
                <span style="color:#470047; margin: 10px 10px 0 -30px;">Proof of Identity:</span>
                    <input type="text" placeholder="Service Name" id="service_name" name="service_name">
                </div>
    
                <div class="row" id="id-row" style="display: none;  color: white;">
                <span style="margin: 10px 10px 0 -30px;">Proof of Identity:</span>
                <input type="file" placeholder="ID verification" id="id_img" name="id_img" required>
                </div>
                <div class="row2" id="tnc">
                <input type="checkbox" id="acceptTerms" name="acceptTerms" style="width: 20px; height: 20px;" required>
                <label for="acceptTerms" style="margin-top: -10px; font-size: 18px;">I accept the <a href="#" style="color: #FFB94E;" data-toggle="modal" data-target="#termsAndConditionsModal">Terms & Conditions</a>
            </label>
            </div>

                <br>
                <div class="row" id="subtn">
                    <input type="submit" value="SIGN UP" id="login">
                </div>

                <div class="row2" style="color:white; text-align: center; font-size:18px;">Already have an account? 
                    <a href="login" style="color: #FF8F2F;">&nbsp;Click here! </a></div>
                    
                </div>
            </form>
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
                        <!-- Add your terms and conditions content here -->
                        <b>Conditions of use</b><br><br>
                        By using this website, you certify that you have read and reviewed this Agreement and that you agree to comply with its terms. If you do not want to be bound by the terms of this Agreement, you are advised to stop using the website accordingly. TaskTackles only grants use and access of this website, its products, and its services to those who have accepted its terms.
                        <br><br><b>Confidentiality</b><br><br>
                        Full confidentiality will be assured. No information that discloses your identity will be released or published without your specific consent to the disclosure and only necessary. The materials that contained the raw information from you will be destroyed after data processing within a given period of time.
                        <br><br><b>Age restriction</b><br><br>
                        You must be at least 18 (eighteen) years of age before you can use this website. By using this website, you warrant that you are at least 18 years of age and you may legally adhere to this agreement. TaskTackles  assumes no responsibility for liabilities related to age representation.
                        <br><br><b>User accounts</b><br><br>
                        As a user of this website, you may be asked to register with us and provide private information. You are responsible for ensuring the accuracy of this information, and you are responsible for maintaining the safety and security of your identifying information. You are also responsible for all activities that occur under your account or password.
                        If you think there are any possible issues regarding the security of your account, inform us immediately so we may address them accordingly.
                        We reserve all rights to terminate accounts, edit, remove or cancel content at our sole discretion.
                        <br><br><b>Limitation on liability</b><br><br>
                        TaskTackles is not liable for any loss or damages that may occur to you while your booked service is ongoing.
                        TaskTackles reserves the right to edit, modify, and change this Agreement at any time. We shall let out users know of these changes through electronic mail. This Agreement is an understanding between TaskTackles and the user. And this supersedes and replaces all prior agreements regarding the use of this website.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End div for Modal -->

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
                    serviceNameInput.style.display = 'flex';
                    idVal.style.display = 'flex';
                } else {
                    serviceNameInput.style.display = 'none';
                    idVal.style.display = 'flex';
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
