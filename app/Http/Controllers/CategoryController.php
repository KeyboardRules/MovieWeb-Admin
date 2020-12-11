<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    function CategoryListView(Request $request){
        $category_id=Category::query();
        $category_id->iD($request);

        $category_name=Category::query();
        $category_name->name($request);

        $categories=$category_id->union($category_name);

        return view("admin.views.category-list",["categories"=>$categories->paginate(10)->appends(request()->input())]);
    }
    function SubmitCategoryView($id=0){
        if($id!=0){
            $category=Category::find($id);
            if(!empty($category)){
                return view("admin.views.category-submit",["category"=>$category,"id"=>$id]);
            }
            else{
                return redirect()->route("category.create");
            } 
        }
        else{
            return view("admin.views.category-submit",["id"=>$id]);
        }
    }
    function SubmitCategory(Request $request,$id=0){
        $data = $request->validate([
            'name_category' => 'required|max:255',
            'description' => 'nullable',
        ]);
        if($id==0){
            $category=new Category($data);
            if($category->save()){
                return redirect()->route("categories")->with('message','Thêm thành công')->with('class','alert alert-success');
            }
            return redirect()->route("categories")->with('message','Có lỗi xảy ra,xin thử lại')->with('class','alert alert-danger');
            
        }
        else{
            $category=Category::find($id);
            $category->name_category=$request->name_category;
            $category->description=$request->description;

            if($category->save()){
                return redirect()->route("categories")->with('message','Sửa thành công')->with('class','alert alert-success');
            }
            return redirect()->route("categories")->with('message','Có lỗi xảy ra,xin thử lại')->with('class','alert alert-danger');
        }
    }
    function DeleteCategory($id){
        $category=Category::find($id);
        if(!empty($category)){
            if($category->delete()){
                return redirect()->route("categories")->with('message','Xóa thành công')->with('class','alert alert-success');
            }
            return redirect()->back()->with('message','Có lỗi xảy ra,xin thử lại')->with('class','alert alert-danger');
        }
        else{
            return redirect()->back()->with('message','Xóa thất bại,Phim đã không còn tồn tại')->with('class','alert alert-danger');;
        }
    }
}
