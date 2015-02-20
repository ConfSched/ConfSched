<!doctype html>
<html>
<head>
</head>
<body>
    <p>Hello {{ $member->name_first }} {{ $member->name_last }},</p>

    <p>You are recieving this email because you are a committee member for {{ $conference }}. Use the link found in this email to register your ConfSched account so that you may provide your feedback on the accepted papers. Your feedback will help us generate a better schedule.</p>

    <p><a href="{{ action('UserController@register', ['id' => $member->reviewerid, 'committee' => '1']) }}">{{ action('UserController@register', ['id' => $member->reviewerid, 'committee' => '1']) }}</a></p>
</body>
</html>