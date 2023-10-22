@include ('ext.sidenavbar')

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style>
        .message-sender {
            text-align: right;
            background-color: #cce6ff; 
        }

        .message-receiver {
            text-align: left;
            background-color: #f0f0f0; 
        }

        .message-container {
            border: 1px solid #ccc;
            padding: 20px;
            max-height: 100%;
            overflow-y: scroll;
        }

        .message-input {
            width: 80%;
            padding: 10px;
            margin: 0 20px;
        }

        .send-button {
            width: 15%;
            padding: 10px;
            background-color: #FF8F2F;
            color: #fff;
            border: none;
            cursor: pointer;
            
        }

        .custom-primary-button {
	        background-color: #FF8F2F;
	        color: #fff;
	        padding: 5px 20px;
	        border: none;
	        cursor: pointer;
	        font-size: 26px;
	        border-radius: 16px;
	    }

	    .custom-primary-button:hover {
	        background-color: #F97134;
	    }

	    /* COLOR SCHEMES (DARK TO LIGHT)
			PURPLE:
			#470047
			#6F0B5B
			#A02B68

			ORANGE:
			#F97134
			#FF8F2F
			#FFB94E
		*/
    </style>
</head>
<body>
<div class="navpad"></div>

<div class="msghead" style="background-color: #470047;">{{ $user->firstname }} {{ $user->lastname }} ({{ $user->username }})</div>

<div class="message-container">
	<a href="/provmsg" class="custom-primary-button">Back</a>
    <ul style="margin-top: 20px;">
        @foreach ($messages->sortBy('timestamp') as $message)
            @php
                $messageTimestamp = \Carbon\Carbon::parse($message->timestamp)->timezone('Asia/Manila');
                $today = now()->timezone('Asia/Manila')->startOfDay();
            @endphp
            @if ($message->user_sender_id == $UserId)
                <li class="message-sender">
                    <p style="font-size:26px">{{ $message->text }}</p>
                    <p style="font-size:14px">
                        @if ($messageTimestamp->greaterThanOrEqualTo($today))
                            {{ $messageTimestamp->format('g:i A') }} {{-- Format time in 12-hour format --}}
                        @else
                            {{ $messageTimestamp }}
                        @endif
                    </p>
                </li>
            @else
                <li class="message-receiver">
                    <p style="font-size:26px">{{ $message->text }}</p>
                    <p style="font-size:14px">
                        @if ($messageTimestamp->greaterThanOrEqualTo($today))
                            {{ $messageTimestamp->format('g:i A') }} {{-- Format time in 12-hour format --}}
                        @else
                            {{ $messageTimestamp }}
                        @endif
                    </p>
                </li>
            @endif
        @endforeach
    </ul>
</div>
<div class="message-input-form" style="width:100%;">
    <form method="post" action="{{ route('sendMessage') }}">
        @csrf
        <input type="text" name="message" class="message-input" placeholder="Type your message here" style="font-size:26px">
        <input type="hidden" name="user_receiver_id" value="{{ $user->id }}">
        <input type="hidden" name="user_sender_id" value="{{ $UserId }}">
        <button type="submit" class="send-button" style="font-size:26px">Send</button>
    </form>
</div>
</body>
</html>
