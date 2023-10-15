@include ('ext.navbar')

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/admin/adminhome.css') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<body>
<div class="bodyct">
    <div class="table1">
        <ul id="menuItems">
            <li><a href="#" class="tab-link active" data-tab="users">Users</a></li>
            <li><a href="#" class="tab-link" data-tab="services">Services</a></li>
            <li><a href="#" class="tab-link" data-tab="bookings">Bookings</a></li>
            <li><a href="#" class="tab-link" data-tab="ratings">Ratings</a></li>
        </ul>
    </div>
    <div class="t1c1" id="contentContainer">
    	<div id="usersContent">
        <ul>
            <li><a href="#">Username</a></li>
            <li><a href="#">Email</a></li>
            <li><a href="#">First Name</a></li>
            <li><a href="#">Last Name</a></li>
            <li><a href="#">Birthday</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Address</a></li>
        </ul>
    	</div>
    	<div id="servicesContent" style="display: none;">
    		<ul>
            <li><a href="#">Service Name</a></li>
            <li><a href="#">Price</a></li>
            <li><a href="#">Description</a></li>
            <li><a href="#">Photo</a></li>
            <li><a href="#">Category</a></li>
            <li><a href="#">Status</a></li>
        </ul>
        </div>

        <div id="bookingsContent" style="display: none;">
    		<ul>
            <li><a href="#">Service Name</a></li>
            <li><a href="#">Provider</a></li>
            <li><a href="#">Customer</a></li>
            <li><a href="#">Date & Time</a></li>
            <li><a href="#">Status</a></li>
            <li><a href="#">Payment Status</a></li>
        </ul>
        </div>

        <div id="bookingsContent" style="display: none;">
    		<ul>
            <li><a href="#">Service Name</a></li>
            <li><a href="#">Provider</a></li>
            <li><a href="#">Customer</a></li>
            <li><a href="#">Date & Time</a></li>
            <li><a href="#">Status</a></li>
            <li><a href="#">Payment Status</a></li>
        </ul>
        </div>

        <div id="ratingsContent" style="display: none;">
    		<ul>
            <li><a href="#">Booked Service</a></li>
            <li><a href="#">Reviewer</a></li>
            <li><a href="#">Recipient</a></li>
            <li><a href="#">Date & Time</a></li>
            <li><a href="#">Rating</a></li>
            <li><a href="#">Comment</a></li>
        </ul>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(".tab-link").click(function () {
        $(".tab-link").removeClass("active");
        $(this).addClass("active");
        
        // Hide all content sections
        $("#contentContainer > div").hide();
        
        // Show the content section based on the data attribute
        const tabName = $(this).data("tab") + "Content";
        $("#" + tabName).show();
    });
</script>
</body>
</html>
