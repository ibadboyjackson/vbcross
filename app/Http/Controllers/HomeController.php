<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userTotalLikes = 0;
        $posts = Post::with('likes')->where('user_id' , Auth::id())->get();

        foreach ($posts as $post){
            $userTotalLikes = $userTotalLikes + $post->likers()->count();
        }

        return view('home',  compact('userTotalLikes'));
    }
}
