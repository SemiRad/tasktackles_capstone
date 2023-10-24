@include ('ext.navbar')

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
@foreach($services as $services )
	<div class="topbar"></div>
    <div class="content">
        <div class="slideshow-container">
            <div class="mySlides">
                <img src="{{ asset('asset/img1.jpg') }}" alt="Image 1">
            </div>
            <div class="mySlides">
                <img src="{{ asset('asset/img2.jpg') }}" alt="Image 2">
            </div>
            <div class="mySlides">
                <img src="{{ asset('asset/img3.jpg') }}" alt="Image 3">
            </div>
            <div class="mySlides">
                <img src="{{ asset('asset/img4.jpg') }}" alt="Image 4">
            </div>
            <div class="mySlides">
                <img src="{{ asset('asset/img5.jpg') }}" alt="Image 5">
            </div>
            <div class="mySlides">
                <img src="{{ asset('asset/img6.jpg') }}" alt="Image 6">
            </div>
            <div class="mySlides">
                <img src="{{ asset('asset/img7.jpg') }}" alt="Image 7">
            </div>
            <div class="mySlides">
                <img src="{{ asset('asset/img8.jpg') }}" alt="Image 8">
            </div>

            <div class="centered-box">
			    <h1>Task for Help</h1>
			    <p style="letter-spacing: -6px; color: #470047;">-----------------------</p>		
			        <p>What task would you like us to tackle?</p>
			        <br>
                    <form action="{{ route('search', ['selectedCategory' => $services->category]) }}" method="post">
    @csrf
    
    <div class="dropdown-container">
        <select name="category" id ="category" required>
            <option value="">Choose...</option>
            <option value="Kitchen">Kitchen</option>
            <option value="LivingRoom">Living Room</option>
            <option value="Bedroom">Bedroom</option>
            <option value="Bathroom">Bathroom</option>
            <option value="Plumbing">Plumbing</option>
            <option value="Electricity">Electricity</option>
            <option value="Yard">Yard/Lawn</option>
            <option value="Others">Others</option>
        </select>
        <button type="submit" class="find-button">Search Services</button>
    </div>
</form>

			</div>
        </div>
    </div>
    @endforeach

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            const slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.opacity = 0;
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            slides[slideIndex - 1].style.opacity = 1;
            setTimeout(showSlides, 5000); // Change image every 2 seconds
        }

        const form = document.getElementById("form");
        const cat = document.getElementById('category');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const catValue = cat.value;

            if (catValue) {
                // Redirect to the services page with the selected category
                window.location.href = `/services?category=${catValue}`;
            } 
        });


    </script>
</body>
</html>