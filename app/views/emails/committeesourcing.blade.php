<!doctype html>
<html>
<head>
</head>
<body>
    <p>Hello {{ $user->first_name }} {{ $user->last_name }},</p>

    <p>Committee sourcing is now open. <a href="{{ action('ConferenceController@getIndex') }}">Click here</a> to go to your dashboard.</p>
</body>
</html>
