<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>つぶやきアプリ</title>

    </head>
    <body>
        <h1>つぶやきを編集する</h1>
        <div>
            <a href="{{ route('tweet.index') }}">＜ 戻る</a>
            <p>投稿フォーム</p>
            @if (session('feedback.success'))
                <p style="color: green">{{ session('feedback.success') }}</p>
            @endif
            <form action="{{ route('tweet.update.put', ['tweetId' => $tweet->id]) }}" method="post">
                @method('PUT')
                @csrf
                <label for="tweet-content">つぶやき</label>
                <span>140文字まで</span>
                <textarea id="tweet-content" type="text" name="tweet" placeholder="つぶやきを入力">{{ $tweet->content }}</textarea>
                @error('tweet')
                <p style="color: red;">{{ $message }}</p>
                @enderror
                <button type="submit">投稿</button>
            </form>
        </div>
    </body>
</html>
