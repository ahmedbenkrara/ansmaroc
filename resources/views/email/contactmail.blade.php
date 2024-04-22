<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonce Maroc</title>
</head>
<body>
    <h1>Sujet : {{$details['subject']}}</h1>
    <h2>Prénom : {{$details['fname']}} Nom : {{$details['sname']}}</h2>
    <h2>Email :{{$details['email']}}</h2>
    <h2>Message :</h2>
    <p>{{$details['message']}}</p>
</body>
</html>