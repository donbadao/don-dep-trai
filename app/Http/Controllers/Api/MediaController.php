<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function fetch()
    {
        $data = $this->get_all_folder_and_files(public_path('contents/uploads'));

        return response()->json($data);
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
                    'file_size'=>filesize($fileName),
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
