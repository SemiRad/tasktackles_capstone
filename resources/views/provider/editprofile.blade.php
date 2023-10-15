@include ('ext.sidenavbar')


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
        <form action="{{ route('updatepage', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">


            <input type="hidden" name="user_id" value="{{$user->id}}">
            @csrf
            <h1> PROFILE DETAILS</h1>
            <br>
            <div class = "dividers">
                <label>Change photo:</label>
                <input type="file" id="photo" name="profile_picture" accept="image/*" value="{{$user->profile_picture}}"  >
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
                    <label>Contact Number:</label><input type="number" placeholder="Aa" name="contact" value="{{$user->contact}}" required>
                </div>
                <span>
                @error('contact')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
            </div>
            <div class="dividers">
                <div class="row">
                    <label>Address:</label><input type="text" style="width: 350px;" placeholder="Aa" name="address" value="{{$user->address}}" required>
                </div>
                <span>
                @error('address')
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
                    <label>Email Address:</label><input type="text" placeholder="Aa" name="email_address" value="{{$user->email_address}}" required>
                </div>
                <span>
                @error('email_address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
                <div class="row">
                      <label>Service Name:</label><input type="text" placeholder="Aa" name="service_name" value="{{$user->service_name}}"required>
                </div>
                <span>
                @error('service_name')
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
    </div>

    </body>
</section>
</html>