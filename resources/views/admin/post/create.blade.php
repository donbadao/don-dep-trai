@extends('admin.layouts.master')
@section('title','Tạo bài viết mới')
@section('content')


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <iframe width="100%" height="500px;" src="admin/media"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<form action="admin/post/create" method="post">
    @csrf
    <div id="page-title" class="page-title">
        <div class="left">
            <h1>Tạo bài viết mới</h1>
        </div>
        <div class="right">
            <a href="admin/post/" class="btn btn-secondary mt-2"><i class="fad fa-arrow-circle-left"></i> Quay lại</a>
            <button href="" class="btn btn-primary mt-2" type="submi"><i class="fad fa-plus-circle"></i> Lưu</button>
        </div>
        <div class="clear"></div>
    </div>
    <div class="row">
        <div class="col-md-9">

            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Tiêu đề bài viết <span class="text-danger">(*)</span></label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Nhập tiêu đề bài viết..." />
                    </div>
                    <div class="form-group mb-3">
                        <label>Mô tả ngắn bài viết <span class="text-danger">(*)</span></label>
                        <textarea placeholder="Nhập mô tả ngắn bài viết..." class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nội dung bài viết <span class="text-danger">(*)</span></label>
                        <textarea placeholder="Nhập mô tả ngắn bài viết..." class="form-control" id="content" name="content" rows="3"></textarea>
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
                                <input id="PostUrl" name="PostUrl" type="text" class="form-control" placeholder="Ví dụ: bai-viet-mau" aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-group">
                        <label>Ảnh đại diện <span class="text-danger">(*)</span></label>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Danh mục <span class="text-danger">(*)</span></label>
                        <select id="categories" name="categories" class="form-select">
                            <option value="0">--Chọn danh mục--</option>
                            @foreach($categories as $category)
                                <option value="{{$category->cat_id}}">{{$category->cat_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>


<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection