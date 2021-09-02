<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "post";
    protected $primaryKey = "post_id";
    protected $dateFormat = 'd-m-Y';


    public static function updateView($id)
    {
        $post = Post::find($id);
        $post->post_views = $post->post_views + 1;
        $post->save();
    }

    public static function updateStats($id)
    {
        $post = Post::find($id);
        $post->post_feature = $post->post_feature ==0 ? 1 : 0;
        $post->save();
    }

    public function User(){
        return $this->hasOne('App\Models\User');
    }
}
