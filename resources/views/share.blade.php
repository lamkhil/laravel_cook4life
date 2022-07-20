<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$resep->deskripsi}}">
    <meta name="keywords" content="{{$resep->kategori->nama_kategori}}">
    <meta name="author" content="{{$resep->user->name}}">

    <title>{{$resep->nama_resep}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        div.container4 {
            height: 10em;
            position: relative
        }

        div.container4 p {
            margin: 0;
            background: yellow;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%)
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body>
    <div class=container4>
        <form action="https://play.google.com/store/apps/details?id=com.snepy.cook4life">
            <input type="submit" value="Download Cook4life" />
        </form>
    </div>
</body>

</html>