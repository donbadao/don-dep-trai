<?php

namespace App\Http\Controllers;

use Event;
use App\Events\CounterViewEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function detail($url)
    {
        $post = DB::table('post')->where('post_url', $url)->first();
        // $post = Post::find(2);
        //Lắng nghe sự kiện xem bài viết

        event(new CounterViewEvent($post));


        return view('frontend.post.detail', compact('post'));
    }
}
