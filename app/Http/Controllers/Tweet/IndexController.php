<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {
        //$tweets = Tweet::all();
        //$tweets = Tweet::orderBy('created_at', 'DESC')->get();
        $tweets = $tweetService->getTweets();
        //dd($tweets);
        return view('tweet.index')
            ->with('name', 'laravel')
            ->with('tweets', $tweets);
    }
}
