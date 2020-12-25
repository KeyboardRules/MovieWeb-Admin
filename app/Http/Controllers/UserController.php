<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Authority;
use App\Models\Review;

class UserController extends Controller
{
    function listAdmin(){
        $id=3;
        return view("admin.views.userList",["users"=>User::all()]);
    }
    function ListUserView(Request $request){
        $user_id=User::query();
        $user_id->iD($request)->auth($request);

        $user_name=User::query();
        $user_name->name($request)->auth($request);

        $users=$user_id->union($user_name);

        return view("admin.views.user-list",["users"=>$users->paginate(10)->appends(request()->input()),"auths"=>Authority::all()]);
    }
    function DetailUserView($id=0){
        $user=User::find($id);
        if(!empty($user)){
            $reviews=Review::query()->where('person_review',$id);//$user->roles()->save($role);
            return view('admin.views.user-detail',["user"=>$user,"reviews"=>$reviews->paginate(10)->appends(request()->input())]);
        }
        else{
            return redirect()->route('users');
        }
    }
    function DeleteUser(Request $request,$id=0){
        $user=User::find($id);
        if(!empty($user)){
            $file=explode("/",$user->image_user);
            $fileName='C:\xampp\htdocs\ImageServer\Users'. DIRECTORY_SEPARATOR .end($file);
            if(file_exists($fileName)){
                unlink($fileName);
            }
            $user->delete();
            return redirect()->route("users")->with('message','Xóa thành công')->with('class','alert alert-success');
        }
        else{
            return redirect()->route("users")->with('message','Xóa thất bại,Người dùng đã không còn tồn tại')->with('class','alert alert-danger');;
        }
    }
}
