<!doctype html>
<html>
<head>
</head>
<body>
    <p>Hello {{ $author->full_name }},</p>

    <p>You are recieving this email because one or more of your papers were accepted to {{ $conference }} and because you are also a commitee member to {{ $conference }}. Use the link found in this email to register your ConfSched account so that you may provide your feedback on what papers you would be interested in seeing and what papers are relevant to yours. You will also be able to supply feedback as a commitee member on what papers should be categorized together.</p>

    <p><a href="{{ action('UserController@register', ['authorid' => $author->id, 'committeeid' => $member->reviewerid]) }}">{{ action('UserController@register', ['authorid' => $author->id, 'committeeid' => $member->reviewerid]) }}</a></p>
</body>
</html>