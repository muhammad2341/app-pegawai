<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    @foreach ($posts as $p)
        <h3>{{ $p['title'] }}</h3>
        <p><strong>{{ $p['author'] }}</strong></p>
        <p>{{ $p['isi'] }}</p>
    @endforeach
</body>
</html>