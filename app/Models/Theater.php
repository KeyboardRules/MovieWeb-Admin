<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    use HasFactory;
    protected $table = 'tb_theaters';
    protected $primaryKey='id_theater';
    protected $fillable = [
        'name_theater',
        'address_theater',
        'image_theater',
        'description_theater'
    ];
    public function movies(){
        return $this->belongsToMany('App\Models\Movie','tb_movies_theaters','theater','movie')->withPivot('from_date','to_date');
    }
    public function scopeID($query,Request $request){
        if($request->name_theater!=""){
            $query->where('id_theater', $request->name_theater);
        }
        return $query;
    }
    public function scopeName($query,Request $request){
        if($request->name_theater!=""){
            $query->where('name_theater', 'LIKE', '%' . $request->name_theater . '%');
        }
        return $query;
    }
    public function scopeTheater($query,Request $request){
        if($request->id_theater!=""){
            $query->where('id_theater', $request->id_theater);
        }
        if($request->name_theater!=""){
            $query->where('name_theater', 'LIKE', '%' . $request->name_theater . '%');
        }
        return $query;
    }

}
