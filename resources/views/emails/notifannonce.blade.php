<!DOCTYPE html>
<html>

<head>
    <title>{{ env('APP_NAME') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
</head>

<body>
Vous avez recu un message en rapport a l' <a href="{{ route('detail_annonce', $annonce_id) }}">annonce</a> sur {{ env('APP_NAME') }}. Cliquer ici pour lire le message
<a href="{{ url('chatify/'.$message_id) }}" class="btn">Lire le message ici</a>
</body>

</html>
