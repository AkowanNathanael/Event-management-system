<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Email</title>
</head>
<body>
<h1 class="text-danger text-center">Welcome to Laravel Email {{ $user->name }}</h1>
<img width="500px" height="500px" src="{{ $message->embed('storage/artists/8EvDKwOQ3lSBXpcyaHMA7MjJcChH6aXMDFZY6CTT.jpg') }}" alt="my image" class="image">
</body>
</html>
