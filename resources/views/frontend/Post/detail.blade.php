@extends('frontend.layouts.master')

@section('content')

<div class="post_content">
    <h1>{{$post->post_title}}</h1>
    <div class="content">
        {!!$post->post_content!!}
    </div>
</div>

@endsection