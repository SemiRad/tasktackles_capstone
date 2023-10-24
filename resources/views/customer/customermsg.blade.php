@include ('ext.custsidenav')

<!DOCTYPE html>
<html>
<head>
	<link rel = "stylesheet" href="{{ asset('css/message.css') }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div class="navpad"></div>
	<div class="msghead">Messages</div>
	@php
        $displayedUsernames = []; // Array to track displayed usernames
    @endphp
    <div class="content">
        @foreach($messages as $message)
            @if ($user->id === $message->user_sender_id || $user->id === $message->user_receiver_id)
                @php
                    $otherUserId = $user->id === $message->user_sender_id ? $message->user_receiver_id : $message->user_sender_id;
                    $otherUser = $user->where('id', $otherUserId)->first();
                @endphp
                @if (!in_array($otherUser->username, $displayedUsernames))
                <a href="/viewConversationCustomer/{{ $otherUser->id }}" style="color: black;">
                    <div class="row">
                        <span class="msger">{{ $otherUser->username }}</span> <i>({{ $otherUser->firstname }} {{ $otherUser->lastname }})</i> <br>
                        <span class="msgcon"></span>
                        <span class="status">{{ $message->text }}</span>
                        <p class="timedate">{{ $message->timestamp }}</p>
                    </div>
                </a>
                    @php
                        $displayedUsernames[] = $otherUser->username; // Add the username to the displayed list
                    @endphp
                @endif
            @endif
        @endforeach
		<!-- message row -->
		<div class="msgrow">
		</div>
		<!--end div-->
	</div>
</body>
</html>