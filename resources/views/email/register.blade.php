<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HaoClub</title>
</head>
<body>
    <h1>Hello! {{ $name }}</h1>
    <a href="{{ url('verify/'.$confirm_code) }}">Click To Confirm your Email</a>
</body>
</html>