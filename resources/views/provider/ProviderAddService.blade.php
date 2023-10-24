@include ('ext.sidenavbar')


<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
	<meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="{{ asset('css/addservice.css') }}">
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

        <form action="{{ route('makeService')}}" method="post" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
        
            <h1> Service Details </h1>
            <br>
            <div class="row">
                    Service Photo: <input type="file" id="photo" name="photo" accept="image/png, image/gif, image/jpeg" required>
                </div>
             
                <div class="row">
                    Service list name: <input type="text" placeholder="Aa" name="service_list_name" id="slnin" value="{{ old('service_list_name') }}" maxlength="16" required>
                </div>
                <span>
                @error('service_list_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <div class="row">
                    Category
                    <select name="category" id="category" required>
                        <option value="">Select Category</option>
                        <option value="Kitchen">Kitchen</option>
                        <option value="LivingRoom">Living Room</option>
                        <option value="Bedroom">Bedroom</option>
                        <option value="Bathroom">Bathroom</option>
                        <option value="Plumbing">Plumbing</option>
                        <option value="Electricity">Electricity</option>
                        <option value="Yard">Yard/Lawn</option>
                        <option value="Others">Others</option>
                    </select>
              
                <span id="error-message" style="color: red;"></span>
            </div>

                <br>
                
                <div class="row">
                <div class="row">
                <label for="description">Description:</label></div>
                <textarea id="description" rows="5" cols="100" placeholder="Aa" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="row">
                    City:<input type="text" placeholder="Aa" name="city" value="{{ $user->city}}" required>
                </div>
                <span>
                @error('city')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
                
                <div class="row">
                    Price:<input type="number" placeholder="00.00" name="price" step="1.00" min="100" value="{{ old('price') }}" required>
                </div>
                <span>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
                <div class="row">
                G-Cash Number: </label> <input type="text" placeholder="G Cash number" id="gcashnum" name="gcashnum" value="{{old('gcashnum')}}"  oninput="this.value = this.value.replace(/[^0-9]/g, '');">

             </div>
             <span>
                @error('gcashnum')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </span>
                <br>
                <br>
                <br>
                <div class="row">
                    <input type="submit" value="List Service" id="newpw">
                </div>
                <br>
                <br>
                <br>
            </form>
</div>

    </body>


    <script>

    document.addEventListener("DOMContentLoaded", function () {
    const contactInput = document.getElementById("gcashnum");

    const maxLength = 11;
    contactInput.addEventListener("input", function () {
        if (contactInput.value.length > maxLength) {
            contactInput.value = contactInput.value.slice(0, maxLength);
        }
    });
});

    const sln = document.getElementById("sln");
    const slnInput = document.getElementById("slnin");
    const errorMessage = document.getElementById("error-message");

    slnInput.addEventListener("input", function () {
        const servInput = slnInput.value;

        if (/\d/.test(servInput)) {
            slnInput.value = "";
            errorMessage.textContent = "Numeric values are not accepted";
        } else {
            errorMessage.textContent = "";
        }
    });
</script>



</section>
</html>