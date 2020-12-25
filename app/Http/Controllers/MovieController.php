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
            'image_file'=>'nullable|file|mimes:jpeg,png,jpg,svg|max:2048',
            'trailer_movie'=>'nullable',
            'content_movie'=>'nullable',
            'categories'=>'nullable'
        ]);
        if($id==0){
            $movie=new Movie($data);
            if($movie->save()){
                if($request->hasFile('image_file')){
                    $imageName = 'movie_avatar.'.$movie->id_movie;
                    $request->image_file->move('C:\xampp\htdocs\ImageServer\Movies', $imageName.'.png');
                    //$request->image_file->move(\public_path('Users'), '123312');
                    $movie->image_movie="http://localhost/ImageServer/Movies/".$imageName.'.png';
                }
                if(isset($data['categories'])){
                    $movie->categories()->sync($data['categories']);
                }
                else{
                    $movie->categories()->detach();
                }
                
                $movie->save();
                return redirect()->route("movie.detail",Movie::latest('created_at')->first()->id_movie)->with('message','Thêm thành công')->with('class','alert alert-success');
            }
            return redirect()->route("movie.detail",Movie::latest('created_at')->first()->id_movie)->with('message','Có lỗi xảy ra,xin thử lại')->with('class','alert alert-danger');
            
        }
        else{
            $movie=Movie::find($id);
            $movie->name_movie=$request->name_movie;
            $movie->date_movie=$request->date_movie;
            if($request->hasFile('image_file')){
                $imageName = 'movie_avatar.'.$movie->id_movie;
                $request->image_file->move('C:\xampp\htdocs\ImageServer\Movies', $imageName.'.png');
                //$request->image_file->move(\public_path('Users'), '123312');
                $movie->image_movie="http://localhost/ImageServer/Movies/".$imageName.'.png';
            }
            $movie->trailer_movie=$request->trailer_movie;
            $movie->length_movie=$request->length_movie;
            $movie->content_movie=$request->content_movie;
            if(isset($data['categories'])){
                $movie->categories()->sync($data['categories']);
            }
            else{
                $movie->categories()->detach();
            }

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
                $file=explode("/",$movie->image_movie);
                $fileName='C:\xampp\htdocs\ImageServer\Movies'. DIRECTORY_SEPARATOR .end($file);
                if(file_exists($fileName)){
                    unlink($fileName);
                }
                return redirect()->route("movies")->with('message','Xóa thành công')->with('class','alert alert-success');
            }
            return redirect()->route("movie.detail",Movie::latest('created_at')->first()->id_movie)->with('message','Có lỗi xảy ra,xin thử lại')->with('class','alert alert-danger');
        }
        else{
            return redirect()->route("movies")->with('message','Xóa thất bại,Phim đã không còn tồn tại')->with('class','alert alert-danger');;
        }
    }
}
