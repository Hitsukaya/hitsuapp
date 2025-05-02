<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $content['title'] ?? 'Newsletter' }}</title>
</head>
<body>
    <h1>{{ $content['title'] ?? 'Newsletter' }}</h1>
    <p>{{ $content['body'] ?? 'This is a test message for the newsletter.' }}</p>

    <p>If you no longer wish to receive these emails, you can unsubscribe using the link below:</p>
    <a href="{{ $unsubscribeUrl }}">Unsubscribe</a>
</body>
</html>
