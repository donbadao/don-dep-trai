<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
  public function fetch()
  {

    $posts = DB::table('post')
      ->join('category', 'post_cat_id', '=', 'category.cat_id')
      ->join('user', 'post_user_id', '=', 'user.user_id')
      ->select(array(
        'post_id',
        'post_title', 'cat_name',
        'post_date_create',
        'user_fullname',
        'post_feature',
        'post_views',
        'post_thumb',
        'cat_url',
        'user_id',
        'user_name'
      ))
      ->orderBy("post_id", "desc")
      ->paginate(20);

    return response()->json($posts);
  }

  public function fetchAll()
  {
    $posts = DB::table('post')
      ->join('category', 'post_cat_id', '=', 'category.cat_id')
      ->join('user', 'post_user_id', '=', 'user.user_id')
      ->select(array(
        'post_id',
        'post_title', 'cat_name',
        'post_date_create',
        'user_fullname',
        'post_feature',
        'post_views',
        'post_thumb',
        'cat_url',
        'user_id',
        'user_name'
      ))
      ->orderBy("post_id", "desc")
      ->get();

    return response()->json(['data' => $posts]);
  }
}
