@props([
    'tweets' => []
])
<div class="bg-white rounded-md shadow-lg mt-5 mb-5">
    <ul>
        @foreach($tweets as $tweet)
        <li class="border-b last:border-b-0 border-gray-200 p-4 flex items-start justify-between">
            <div>
                <span class="inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs mb-2">
                    {{$tweet->user->name}}
                </span>
                <p class="text-gray-600">{!! nl2br($tweet->content)!!}</p>
            </div>
            <div>
                <x-tweet.options :tweetId="$tweet->id" :userId="$tweet->user_id"></x-tweet.options>
                <!-- TODO 編集と削除 -->
            </div>
        </li>
        <!--<details>
            <summary>{{ $tweet->content }} by {{$tweet->user->name}}</summary>
            @if(\Illuminate\Support\Facades\Auth::id() === $tweet->user_id)
            <a href="{{ route('tweet.update.index', ['tweetId' => $tweet->id]) }}">編集</a>
            <form action="{{ route('tweet.delete', ['tweetId' => $tweet->id]) }}", method="post">
                @method('DELETE')
                @csrf
                <button type="submit">削除</button>
            </form>
            @else
                編集できません
            @endif
        </details>
        -->
        @endforeach
    </ul>
</div>
