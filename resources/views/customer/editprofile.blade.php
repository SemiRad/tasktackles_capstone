@include ('ext.custsidenav')


<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
	<meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="{{ asset('css/provider/editprofile.css') }}" >
    <link rel = "icon" href = "/asset/icon.png" type = "image/x-icon">
  <title>TaskTackles</title>
</head>

<section>
    <body>

        <div class="wrapper">
        <div class="errormsg">
            <br><br>
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

        <form action="{{ route('update-page', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">


            <input type="hidden" name="user_id" value="{{$user->id}}">
            @csrf
            <h1> PROFILE DETAILS</h1>
            <br>
            <div class="image">
                    <img src="{{ asset('images/' . $user->profile_picture ) }}"></div>
                    <div class = "dividers">
                    <div class="row">
                  
                <label>Change photo:</label>
                <input type="file" id="photo" name="profile_picture" accept="image/*" value="{{$user->profile_picture}}"  > </div>

    
   
               
                <div class="row">
                        <label>First Name:</label><input type="text" placeholder="Aa" name="firstname"value="{{$user->firstname}}" required>
                    </div>
                    <span>
                @error('firstname')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                    <br>
                    <div class="row">
                        <label>Last Name:</label><input type="text" placeholder="Aa" name="lastname" value="{{$user->lastname}}" required>
                    </div>
                    <span>
                @error('lastname')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                    <br>
                    <div class="row">
                        <label>Gender:</label>
                        <select name="gender" id="dropd" required>
                                    <option value="m" {{ $user->gender == 'm' ? 'selected' : '' }}>Male</option>
                                    <option value="f" {{ $user->gender == 'f' ? 'selected' : '' }}>Female</option>
                                    <option value="nb" {{ $user->gender == 'nb' ? 'selected' : '' }}>Non-binary</option>
                                    <option value="none" {{ $user->gender == 'none' ? 'selected' : '' }}>Prefer not to say</option>
                                </select>
                    </div>
                    <br>
                    <div class="row">
                        <label>Birthday:</label><input type="date" placeholder="Aa" name="birthday" value="{{$user->birthday}}" readonly>
                    </div>
                    <span>
                @error('birthday')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
                <div class="row">
                <label>Contact Number:</label>
<input type="text" placeholder="Aa" id="contact" name="contact" value="{{$user->contact}}" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">                </div>
                <span>
                @error('contact')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
            </div>

            <div class="dividers">
            <div class="row">
                    <label>Province:</label><input type="text" placeholder="Aa" name="province" value="{{$user->province}}" required>
                </div>
                <span>
                @error('province')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
                <div class="row">
                    <label>City:</label><input type="text" placeholder="Aa" name="city" value="{{$user->city}}" required>
                </div>
                <span>
                @error('city')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
                <div class="row">
                    <label>Street Address:</label><input type="text" style="width: 350px;" placeholder="Aa" name="street" value="{{$user->street}}" required>
                </div>
                <span>
                @error('street')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
                <div class="row">
                    <label>House Number:</label><input type="text" style="width: 350px;" placeholder="Aa" name="hnum" value="{{$user->hnum}}" >
                </div>
                <span>
                @error('hnum')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
                
                <div class="row">
                    <label>Email Address:</label><input type="text" placeholder="Aa" name="email_address" value="{{$user->email_address}}" required>
                </div>
                <span>
                @error('email_address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
               
          
                <div class="row">
                      <label>Username:</label><input type="text" placeholder="Aa" name="username"value="{{$user->username}}"required>
                </div>
                <span>
                @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
            </div>
                <div class="row">
                    <input type="submit" value="Save Changes" id="save">
                </div>
            </form>
</div>

    </body>
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
</script>
</section>
</html>