<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;
    protected $table = 'tb_categories';
    protected $primaryKey='id_category';
    protected $fillable = [
        'name_category',
        'description'
    ];
    public function movies(){
        return $this->belongsToMany('App\Models\Movie','tb_movies_categories','category','movie');
    }
    public function scopeID($query,Request $request){
        if($request->name_category!=""){
            $query->where('id_category', $request->name_category);
        }
        return $query;
    }
    public function scopeName($query,Request $request){
        if($request->name_category!=""){
            $query->where('name_category', 'LIKE', '%' . $request->name_category . '%');
        }
        return $query;
    }
}
