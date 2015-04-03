<!doctype html>
<html>
<head>
</head>
<body>
    <p>Hello {{ $user->name_first }} {{ $user->name_last }},</p>

    <p>Committee sourcing is now open. <a href="{{ action('ConferenceController@getIndex') }}">Click here</a> to go to your dashboard.</p>
</body>
</html>
