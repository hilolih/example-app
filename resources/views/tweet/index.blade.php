
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>つぶやきアプリ</title>

    </head>
    <body>
        <h1>つぶやきアプリ</h1>
        <p>{{ $name }}</p>
        <div>
        @foreach($tweets as $tweet)
            <p>{{ $tweet->content }}</p>
        @endforeach
        </div> 
    </body>
</html>
