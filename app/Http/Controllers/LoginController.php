<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{
    function LoginView(){
        return view('admin.views.login');
    }
    function Login(Request $request){
        $data = $request->validate([
            'account_user' => 'required|max:40',
            'password' => 'required|alphaNum|min:3|max:20',
        ]);

        if(Auth::attempt($data)){
            return redirect()->route('main');
        }
        else{
            return redirect()->back()->with('message','Thông tin tài khoản sai hoặc tài khoản không tồn tại')->with('class','alert alert-danger');
        }
    }
    public function username()
    {
        return 'account_user';
    }
    public function Logout(){
        Auth::Logout();
        return redirect()->route('login');
    }
}
