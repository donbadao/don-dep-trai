@extends('frontend.layouts.master')

@section('content')

<?php

use Illuminate\Support\Facades\DB;

$posts = DB::table('post')->get();
?>

<ul>
    @foreach($posts as $post)
        <li><a href="post/{{$post->post_url}}">{{$post->post_title}}</a></li>
    @endforeach

</ul>

@endsection