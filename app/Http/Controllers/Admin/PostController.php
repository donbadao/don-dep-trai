<?php

namespace App\Http\Controllers\Admin;

use App\Events\CouterView;
use Event;
use App\Events\NewPost;
use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        return view("admin.post.index");
    }

    public function create()
    {
        $categories = Categories::orderBy("cat_id","desc")->get();
        return view("admin.post.create")->with('categories',$categories);
    }

    public function save(Request $rq)
    {
        $post = new Post();

        $post->post_title = trim($rq->input('title'));
        $post->post_user_id =trim( $rq->session()->get('user_id'));
        $post->post_cat_id = $rq->input('categories');
        $post->post_content = $rq->input('content');
        $post->post_description = trim($rq->input('description'));
        $post->post_image_larg = "";
        $post->post_date_create = now();
        $post->post_url = trim(convert_vi_to_en($post->post_title));
        $post->save();

        addMessages('success', 'Thêm bài viết thành công');


        // Session::
        return redirect('admin/post');
    }

    public function edit($id)
    {
        $post = DB::table('post')->where("post_id", $id)->first();
        return view("admin.post.edit", compact('post'));
    }


    public function delete(Request $rq)
    {
        $id = $rq->input('hd_id');
        if ($id > 0) {
            $post = Post::find($id);
            $post->delete();

            addMessages('success', 'Xóa bài viết thành công');
        }
        return redirect('admin/post');
    }

    public function updateStatus(Request $rq)
    {
        $id = $rq->input('id');
        if ($id > 0) {
            $post = Post::updateStats($id);
            $getPost = Post::find($id);
            return response()->json("Da cap nhat thanh cong " . $getPost->post_feature);
        }
        return response()->json("Da post thanh cong " . $id);
    }
}
