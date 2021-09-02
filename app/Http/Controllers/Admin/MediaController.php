<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Image;

class MediaController extends Controller
{
    public function index()
    {
        $data = $this->get_all_folder_and_files(public_path('contents/uploads'));

        return view("admin.media.index", compact('data'));
    }

    public function uploads(Request $request)
    {


        if (!$request->hasFile('image')) {
            // Nếu không thì in ra thông báo
            return "Mời chọn file cần upload";
        }



        $image = $request->file('image');
        $fullName  = md5(time().$image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
        //    Image::make( $image)->fit(500, 500)->save('contents/thumbs/'.$fullName);
        //    Image::make( $image)->fit(1000, 1000)->save('contents/uploads/'.$fullName);
        //  return $img->response('jpg');
        //$storedPath = $image->move('contents/uploads`', $img);

        $medium = Image::make($image);
        $larg  = Image::make($image);

        $medium->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
        });

        $larg->resize(1000, 1000, function ($constraint) {
            $constraint->aspectRatio();
        });

        $medium->save('contents/thumbs/' . $fullName, 80);
        $larg->save('contents/uploads/' . $fullName, 50);

        return redirect()->back();
    }

    protected function get_all_folder_and_files($full_path = null)
    {
        $return = array();
        $folders = array();
        $files = array();
        if (!file_exists($full_path))
            return null;

        $get_all = array_diff(scandir($full_path), array('.', '..'));
        foreach ($get_all as $f) {
            if (is_dir($full_path . "/" . $f))
                $folders[] = $f;
            else {
                $pathInfo = pathinfo($full_path . "/" . $f);
                $fileName = $full_path . "/" . $f;
                $files[] = array(
                    'files' => $f,
                    'file_create_date' => filemtime($fileName),
                    'file_ext' => $pathInfo['extension'],
                    'file_size' => filesize($fileName),
                );
            }
        }

        $return = [
            'files' => $files,
            'folders' => $folders,
        ];

        return $return;
    }
}
