@extends('admin.layouts.master')
@section('title',$post->post_title)
@section('content')


<form action="/" method="post">
    <div id="page-title" class="page-title">
        <div class="left">
            <h1>Cập nhật bài viết</h1>
        </div>
        <div class="right">
            <a href="admin/post/" class="btn btn-secondary mt-2"><i class="fad fa-arrow-circle-left"></i> Quay lại</a>
            <a href="admin/post/create" class="btn btn-primary mt-2"><i class="fad fa-plus-circle"></i> Lưu</a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="row">
        <div class="col-md-9">

            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Tiêu đề bài viết <span class="text-danger">(*)</span></label>
                        <input type="text" id="title" name="title" value="{{$post->post_title}}" class="form-control" placeholder="Nhập tiêu đề bài viết..." />
                    </div>
                    <div class="form-group mb-3">
                        <label>Mô tả ngắn bài viết <span class="text-danger">(*)</span></label>
                        <textarea placeholder="Nhập mô tả ngắn bài viết..." class="form-control" id="description" name="description" rows="3">{{$post->post_description}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nội dung bài viết <span class="text-danger">(*)</span></label>
                        <textarea placeholder="Nhập nội dung bài viết..." class="form-control" id="content" name="content" rows="5">{{$post->post_content}}</textarea>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title">
                        <div class="left">
                            <h5>Tùy chỉnh đường dẫn <i class="fa fa-link"></i></h5>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="seo-google-content">
                        <div class="form-group">
                            <label>Đường dẫn</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon2">{{url('/post/')}}</span>
                                <input id="PostUrl" name="PostUrl" type="text" class="form-control" placeholder="Ví dụ: bai-viet-mau" aria-describedby="basic-addon2" value="{{$post->post_url}}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</form>

@endsection


@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>


<script>
     ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
</script>
@endsection