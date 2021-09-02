<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $rq)
    {
        if($rq->session()->exists('user_id') && $rq->session()->exists('user_name')){
            return redirect('admin/');
        }
        return view('admin.login.index');
    }

    public function checkLogin(Request $rq)
    {
        $username = $rq->input('username');
        $password = md5($rq->input('password'));

        $userLogin = User::where([
            'user_name' => $username,
            'user_password' => $password
        ])->first();

        if ($userLogin != null) {
         
            session()->put('user_id', $userLogin->user_id);
            session()->put('user_fullname', $userLogin->user_fullname);
            session()->put('user_group_id', $userLogin->user_group_id);
            session()->put('user_name', $userLogin->user_name);

            return redirect('admin/');
            
        } else {
            dd("User khong ton tai");
        }
    }

    public function logOut(Request $request){
        $request->session()->flush();
        return redirect('admin/login');
    }
}
