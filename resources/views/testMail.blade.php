<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Member Esport</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <p>Silahkan klik link ini untuk mendaftar menjadi member team</p>
    <a href="{{url('/registermember')}}">Daftar</a>
    <p>Terima kasih.</p>
</body>

</html>