<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Theater;

class MovieTheaterController extends Controller
{
    function ListTheaterView(Request $request,$id){
        $movie=Movie::find($id);
        if($movie){
            $theaters= $movie->theaters()->theater($request);

            return view("admin.views.movie-theaters-list",["theaters"=>$theaters->paginate(10)->appends(request()->input()),"movie"=>$movie]);
        }
        else{
            return redirect()->route("theaters");
        }
    }
    function MovieListView(Request $request){
        $movies_id=Movie::query();
        $movies_id->id($request)->category($request);

        $movies_name=Movie::query();
        $movies_name->name($request)->category($request);

        $movies=$movies_id->union($movies_name); 
        return view("admin.views.movie-list",["movies"=>$movies->paginate(10)->appends(request()->input()),"categories"=>Category::all()]);
    }
    function SubmitTheaters(Request $request,$id=0){
        $movie=Movie::find($id)->first();
        if($movie){
            $data = $request->validate([
                'theater' => 'required|max:255',
                'from_date' => 'required|date|after_or_equal:'.$movie->date_movie,
                'to_date'=>'required|date|after:from_date',
            ]);
            $theater=Theater::query()->where('name_theater',$data['theater'])->first();
            $query=$movie->theaters()->getQuery()->where('name_theater',$data['theater'])->first();
            if($theater && !$query){
                $movie->theaters()->attach($theater->id_theater,['from_date'=>$data['from_date'],'to_date'=>$data['to_date']]);
                return \redirect()->back()->with('add_message','Thêm thành công')->with('class','alert alert-success');
            }
            if(!$theater){
                return \redirect()->back()->with('add_message','Không tồn tại phim này')->with('class','alert alert-danger');
            }
            if($query){
                return \redirect()->back()->with('add_message','Phim đã bao gồm rạp này')->with('class','alert alert-danger');
            }
        }
        return \redirect()->route('theaters');
    }
    function DeleteTheatersMovies($theater=0,$movie=0){
        Movie::find($movie)->theaters()->detach($theater);
        return \redirect()->back()->with('delete_message','Xóa thành công')->with('class','alert alert-success'); 
    }
}

