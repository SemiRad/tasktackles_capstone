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
        
        <div class="header">
        <h1> Start a New Service</h1>
        </div>
        <div class="wrapper">
                        <div class ="errormsg">
      
                        @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                                @endif

                                @if(session('fail'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('fail') }}
                                    </div>
                                @endif
        </div>
        <form action="{{ route('makeService')}}" method="post" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            
            <br>
            <h1> Service Details </h1>
            <br>
            <label for="photo">Upload a photo:</label>
             <input type="file" id="photo" name="photo" accept="image/png, image/gif, image/jpeg" required>
             <div class="row" id="sln">
                <label for="service_list_name">Service List Name:</label>
                <input type="text" placeholder="Aa" name="service_list_name" id="slnin" value="{{ old('service_list_name') }}" maxlength="16" required>
                <span id="error-message" style="color: red;"></span>
            </div>

                <br>
                <div class="bigtxt">
                    <label for="description">Description: </label>
                    <textarea rows="5" cols="100" placeholder="Aa" name="description" value="{{ old('description') }}"></textarea>

                    <!--<input type="text" placeholder="Aa" id="desc" name="description" value="{{ old('description') }}" size="50" required>-->
                </div>
                <br>
                <div class="row">
                    <label for="price">Price: </label><input type="number" placeholder="00.00" name="price" step="1.00" min="100" value="{{ old('price') }}" required>
                </div>
                <br>
                <div class="row">
                    <label for="gcashnum">G-Cash Number: </label><input type="number" maxlength="11" placeholder="" name="gcashnum" value="{{ old('gcashnum') }}">
                </div>
                <br>
                <div class="row">
                    <input type="submit" value="List Service" id="ss">
                </div>
            </form>
</div>

    </body>


    <script>
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