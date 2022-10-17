<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tweet;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $tweetId = (int) $request->route('tweetId');
        //dd($tweetId);
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
        //if (is_null($tweet)) {
        //    throw new NotFoundHttpException('存在しないつぶやきです');
        //}
        return view('tweet.update')->with('tweet', $tweet);
    }
}
