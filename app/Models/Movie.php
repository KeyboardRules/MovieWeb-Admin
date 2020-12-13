<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'tb_movies';
    protected $primaryKey='id_movie';
    protected $fillable = [
        'name_movie',
        'date_movie',
        'image_movie',
        'trailer_movie',
        'length_movie',
        'content_movie',
    ];
    public function categories(){
        return $this->belongsToMany('App\Models\Category','tb_movies_categories','movie','category');
    }
    public function theaters(){
        return $this->belongsToMany('App\Models\Theater','tb_movies_theaters','movie','theater')->withPivot('from_date','to_date');
    }
    public function reviews(){
        //$role->users()->associate($user);
        return $this->hasMany('App\Models\Review','movie_review','id_movie');
    }
    public function score(){
        return $this->reviews()->avg('score_review');
    }
    public function scopeID($query,Request $request){
        if($request->name_movie!=""){
            $query->where('id_movie', $request->name_movie);
        }
        return $query;
    }
    public function scopeName($query,Request $request){
        if($request->name_movie!=""){
            $query->where('name_movie', 'LIKE', '%' . $request->name_movie . '%');
        }
        return $query;
    }
    public function scopeCategory($query,Request $request){
        if( $request->category!=""&&$request->category!="0"){
            $query->select('tb_movies.*')->join('tb_movies_categories','id_movie','=','tb_movies_categories.movie')
            ->where('tb_movies_categories.category',$request->category);
        }
        return $query;
    }
    public function scopeMovie($query,Request $request){
        if($request->id_movie!=""){
            $query->where('id_movie', $request->id_movie);
        }
        if($request->name_movie!=""){
            $query->where('name_movie', 'LIKE', '%' . $request->name_movie . '%');
        }
        if( $request->category!=""&&$request->category!="0"){
            $query->select('tb_movies.*')->join('tb_movies_categories','id_movie','=','tb_movies_categories.movie')
            ->where('tb_movies_categories.category',$request->category);
        }
        return $query;
    }
}
