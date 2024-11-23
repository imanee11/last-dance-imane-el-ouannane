<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Invitation</title>
</head>
<body>
    <h1>You have been invited to join the team "{{ $invitation->team->name }}" by {{ $invitation->owner->name }}.</h1>
    <p>Click below to accept or reject the invitation:</p>
    <a href="{{ $acceptUrl }}" class="pb-3">Accept Invitation</a><br>
    <a href="{{ $rejectUrl }}" class="pb-3">Reject Invitation</a>
</body>
</html>
