<!doctype html>
<html>
<head>
</head>
<body>
    <p>Hello {{ $author->full_name }},</p>

    <p>You are recieving this email because one or more of your papers were accepted to a conference. Use the link found in this email to register your ConfSched account so that you may provide your feedback on what papers you would be interested in seeing and what papers are relevant to yours.</p>

    <p><a href="{{ action('UserController@register', ['id' => $author->id]) }}">{{ action('UserController@register', ['id' => $author->id]) }}</a></p>
</body>
</html>