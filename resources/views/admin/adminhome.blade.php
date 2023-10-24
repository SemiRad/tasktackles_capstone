@include ('ext.navbar')

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/admin/adminhome.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<body>
<div class="bodyct">
    <table class="table1">
        <tr>
            <td>
                <ul id="menuItems">
                    <li><a href="#" class="tab-link active" data-tab="users">Users</a></li>
                    <li><a href="#" class="tab-link" data-tab="services">Services</a></li>
                    <li><a href="#" class="tab-link" data-tab="bookings">Bookings</a></li>
                    <li><a href="#" class="tab-link" data-tab="ratings">Ratings</a></li>
                </ul>
            </td>
        </tr>
    </table>

    <?php
    use App\Models\User;
    use App\Models\Service;
    use App\Models\Book;
    use App\Models\Rate;
    $user = array();
    if (Session::has('loginID')) {
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();
        $users = User::all();
        $b = Book::all();
        $services = Service::all();
        $r = rate::all();
    }
    ?>

    <div class="t1c1" id="contentContainer">
        <table id="usersContent">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Contact</th>
                <th>Address</th>
                <th>ID</th>
                <th>Status</th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                @foreach($users as $users)
                <td>{{ $users->username }}</td>
                <td>{{ $users->email_address }}</td>
                <td>{{ $users->firstname }} {{ $users->lastname }}</td>
                <td>{{ $users->birthday }}</td>
                <td>{{ $users->contact }}</td>
                <td>{{ $users->city }} {{ $users->address }}</td>
                <td style="padding: 10px 0;"><img src="{{ asset('images/' . $users->id_img) }}" alt="User ID Image" style="max-width: 150px" data-toggle="modal" data-target="#imageModal-{{$users->id}}"></td>
                    <!--modal-->
                    <div class="modal fade" id="imageModal-{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Proof of Identification</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset('images/' . $users->id_img) }}" alt="User ID Image" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end modal-->
                <td>
                    @if($user->isValid == 1)
                        Verified
                        <td><button class="btn btn-danger">Ban</button></td>
                    @else
                        Unverified
                        <td><button class="btn btn-success">Verify</button></td>
                        <td><button class="btn btn-danger">Deny</button></td>
                    @endif
                </td>
            </tr>
                @endforeach
        </table>

        <table id="servicesContent" style="display: none;">
            <tr>
                <th>Service Name</th>
                <th>Provider</th>
                <th>Price</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Category</th>
                <th>Status</th>
            </tr>

            <tr>
                @foreach($services as $services)
                <td>{{ $services->service_list_name }}</td>
                <td>{{ $users->where('id', $services->user_id)->first()->username }}</td>
                <td>PHP {{ $services->price }}</td>
                <td>{{ strlen($services->description) > 70 ? substr($services->description, 0, 70) . '...' : $servicesss->description }}</td>
                <td>
                    <img src="{{ asset('images/' . $services->photo) }}" alt="Service Photo" style="max-width: 150px" data-toggle="modal" data-target="#photoModal-{{$services->id}}">
                </td>
                <!--modal-->
                <div class="modal fade" id="photoModal-{{$services->id}}" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="photoModalLabel">Service Photo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('images/' . $services->photo) }}" alt="Service Photo" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
                <!--end modal-->
                <td>{{ $services->category }}</td>
                <td>{{ $services->status }}</td>
                <td>
                    <button class="btn btn-danger">Delete</button>
                </td>
            </tr>
                @endforeach
        </table>

        <table id="bookingsContent" style="display: none;">
            <tr>
                <th>Service Name</th>
                <th>Provider</th>
                <th>Customer</th>
                <th>Date & Time</th>
                <th>Location</th>
                <th>Status</th>
                <th>Payment Status</th>
            </tr>

            <tr>
                @foreach($b as $b)
                <td>{{ $services->where('id', $b->service_id)->first()->service_list_name }}</td>
                <td>{{ $users->where('id', $b->user_id_provider)->first()->username }}</td>
                <td>{{ $users->where('id', $b->user_id_customer)->first()->username }}</td>
                <td>{{ $b->date }} &nbsp; {{ $b->time }}</td>
                <td>{{ $users->where('id', $b->user_id_customer)->first()->city }}, {{ $b->location }}</td>
                <td>{{ $b->status }}</td>
                <td style="padding:10px;">{{ $b->payment_status }}</td>
            </tr>
                @endforeach
        </table>

        <table id="ratingsContent" style="display: none;">
            <tr>
                <th>Booked Service</th>
                <th>Reviewer</th>
                <th>Recipient</th>
                <th>Date & Time</th>
                <th>Rating</th>
                <th>Comment</th>
                <th></th>
            </tr>

            @foreach($r as $r)
                <td>{{ $services->where('id', $b->where('id', $r->booking_id)->first()->service_id)->first()->service_list_name }}</td>
                <td>{{ $users->where('id', $r->user_id_reviewer)->first()->username }}</td>
                <td>{{ $users->where('id', $r->user_id_recipient)->first()->username }}</td>
                <td>{{ $r->created_at }}</td>
                <td>{{ $r->rating }}</td>
                <td>{{ $r->comments }}</td>
                <td style="padding:10px;"><button class="btn btn-danger">Delete</button></td>
            </tr>
                @endforeach
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(".tab-link").click(function () {
        $(".tab-link").removeClass("active");
        $(this).addClass("active");

        // Hide all content sections
        $("#contentContainer > table").hide();

        // Show the content section based on the data attribute
        const tabName = $(this).data("tab") + "Content";
        $("#" + tabName).show();
    });
</script>
</body>
</html>
