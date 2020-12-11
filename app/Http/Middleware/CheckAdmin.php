<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::user()){
            return redirect()->route('login');
        }
        if(Auth::user()->hasAuth('admin')!=null){
            return $next($request);
        }
        Auth::logout();
        return \redirect()->route('login')->with('message','Tài khoản này không có quyền hạn đăng nhập vào site này')->with('class','alert alert-danger');
    }
}
