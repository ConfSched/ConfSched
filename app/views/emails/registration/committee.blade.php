<!doctype html>
<html>
<head>
</head>
<body>
    <p>Hello {{ $user->name_first }} {{ $user->name_last }},</p>

    <p>You are recieving this email because you are a committee member for {{ $conference }}. Use the link found in this email to register your ConfSched account so that you may provide your feedback on the accepted papers. Your feedback will help us generate a better schedule.</p>

    <p><a href="{{ action('UserController@register', ['committeeid' => $member->reviewerid]) }}">{{ action('UserController@register', ['committeeid' => $member->reviewerid]) }}</a></p>
</body>
</html>
