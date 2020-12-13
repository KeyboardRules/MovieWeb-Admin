<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Review;

class MovieController extends Controller
{
    function MovieListView(Request $request){
        $movies_id=Movie::query();
        $movies_id->id($request)->category($request);

        $movies_name=Movie::query();
        $movies_name->name($request)->category($request);

        $movies=$movies_id->union($movies_name); 
        return view("admin.views.movie-list",["movies"=>$movies->paginate(10)->appends(request()->input()),"categories"=>Category::all()]);
    }
    function MovieDetailView($id){
        $movie=Movie::find($id);
        if(!empty($movie)){
            $reviews=Review::query()->where('movie_review',$id);
            return view("admin.views.movie-detail",["movie"=>$movie,"reviews"=>$reviews->paginate(10)->appends(request()->input())]);
        }
        else{
            return redirect()->route("movies");
        } 
    }
    function SubmitMovieView($id=0){
        if($id!=0){
            $movie=Movie::find($id);
            if(!empty($movie)){
                return view("admin.views.movie-submit",["movie"=>$movie,"id"=>$id]);
            }
            else{
                return redirect()->route("movie.create");
            } 
        }
        else{
            return view("admin.views.movie-submit",["id"=>$id]);
        }
    }
    function SubmitMovie(Request $request,$id=0){
        $data = $request->validate([
            'name_movie' => 'required|max:255',
            'date_movie' => 'required|date',
            'length_movie'=>'required',
            'image_movie'=>'nullable',
            'trailer_movie'=>'nullable',
            'content_movie'=>'nullable',
            'categories'=>'nullable'
        ]);
        if($id==0){
            $movie=new Movie($data);
            if($movie->save()){
                $movie->categories()->sync($data['categories']);
                return redirect()->route("movie.detail",Movie::latest('created_at')->first()->id_movie)->with('message','Thêm thành công')->with('class','alert alert-success');
            }
            return redirect()->route("movie.detail",Movie::latest('created_at')->first()->id_movie)->with('message','Có lỗi xảy ra,xin thử lại')->with('class','alert alert-danger');
            
        }
        else{
            $movie=Movie::find($id);
            $movie->name_movie=$request->name_movie;
            $movie->date_movie=$request->date_movie;
            $movie->image_movie=$request->image_movie;
            $movie->trailer_movie=$request->trailer_movie;
            $movie->length_movie=$request->length_movie;
            $movie->content_movie=$request->content_movie;
            $movie->categories()->sync($data['categories']);

            if($movie->save()){
                return redirect()->route("movie.detail",$id)->with('message','Sửa thành công')->with('class','alert alert-success');
            }
            return redirect()->route("movie.detail",Movie::latest('created_at')->first()->id_movie)->with('message','Có lỗi xảy ra,xin thử lại')->with('class','alert alert-danger');
        }
    }
    function DeleteMovie(Request $request,$id){
        $movie=Movie::find($id);
        if(!empty($movie)){
            if($movie->delete()){
                return redirect()->route("movies")->with('message','Xóa thành công')->with('class','alert alert-success');
            }
            return redirect()->route("movie.detail",Movie::latest('created_at')->first()->id_movie)->with('message','Có lỗi xảy ra,xin thử lại')->with('class','alert alert-danger');
        }
        else{
            return redirect()->route("movies")->with('message','Xóa thất bại,Phim đã không còn tồn tại')->with('class','alert alert-danger');;
        }
    }
}
