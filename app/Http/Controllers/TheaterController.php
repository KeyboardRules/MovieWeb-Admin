<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theater;

class TheaterController extends Controller
{
    function ListTheaterView(Request $request){
        $theaters_id=Theater::query();
        $theaters_id->iD($request);

        $theaters_name=Theater::query();
        $theaters_name->name($request);

        $theaters=$theaters_id->union($theaters_name);

        return view("admin.views.theater-list",["theaters"=>$theaters->paginate(10)->appends(request()->input())]);
    }
    function DetailTheaterView($id){
        $theater=Theater::find($id);
        if(!empty($theater)){
            return view("admin.views.theater-detail",["theater"=>$theater,])->with('title',$theater->name_theater);
        }
        else{
            return redirect()->route("theaters");
        } 
    }
    function SubmitTheaterView($id=0){
        if($id!=0){
            $theater=Theater::find($id);
            if(!empty($theater)){
                return view("admin.views.theater-submit",["theater"=>$theater,"id"=>$id]);
            }
            else{
                return redirect()->route("theater.create");
            } 
        }
        else{
            return view("admin.views.theater-submit",["id"=>$id])->with('title','Thêm rạp chiếu phim');
        }
    }
    function SubmitTheater(Request $request,$id=0){
        $data = $request->validate([
            'name_theater'=>'required|max:255',
            'address_theater'=>'required',
            'image_file'=>'nullable|file|mimes:jpeg,png,jpg,svg|max:2048',
            'description_theater'=>'nullable'
        ]);
        if($id==0){
            $theater=new Theater($data);
            $theater->save();
            if($request->hasFile('image_file')){
                $imageName = 'movie_avatar.'.$theater->id_theater;
                $request->image_file->move('C:\xampp\htdocs\ImageServer\Theaters', $imageName.'.png');
                //$request->image_file->move(\public_path('Users'), '123312');
                $theater->image_theater="http://localhost/ImageServer/Theaters/".$imageName.'.png';
            }
            $theater->save();
            return redirect()->route("theater.detail",Theater::latest('created_at')->first()->id_theater)->with('message','Thêm thành công')->with('class','alert alert-success');;
        }
        else{
            $theater=Theater::find($id);
            $theater->name_theater=$request->name_theater;
            $theater->address_theater=$request->address_theater;
            if($request->hasFile('image_file')){
                $imageName = 'movie_avatar.'.$theater->id_theater;
                $request->image_file->move('C:\xampp\htdocs\ImageServer\Theaters', $imageName.'.png');
                //$request->image_file->move(\public_path('Users'), '123312');
                $theater->image_theater="http://localhost/ImageServer/Theaters/".$imageName.'.png';
            }
            $theater->description_theater=$request->description_theater;

            $theater->save();
            return redirect()->route("theater.detail",$id)->with('message','Sửa thành công')->with('class','alert alert-success');
        }
    }
    function DeleteTheater(Request $request,$id){
        $theater=Theater::find($id);
        if(!empty($theater)){
            if($theater->delete()){
                $file=explode("/",$theater->image_theater);
                $fileName='C:\xampp\htdocs\ImageServer\Theaters'. DIRECTORY_SEPARATOR .end($file);
                if(file_exists($fileName)){
                    unlink($fileName);
                }
                return redirect()->route("theaters")->with('message','Xóa thành công')->with('class','alert alert-success');
            }
        }
        else{
            return redirect()->route("theaters")->with('message','Xóa thất bại,Rạp chiếu đã không còn tồn tại')->with('class','alert alert-danger');;
        }
    }
}
