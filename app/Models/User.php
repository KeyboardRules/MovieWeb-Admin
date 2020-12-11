<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;
    protected $table = 'tb_users';
    protected $primaryKey='id_user';
    protected $fillable = [
        'name_user',
        'gender_user',
        'birth_user',
        'image_user',
        'email_user',
        'auth_user'
    ];
    protected $hidden = [
        'account_user',
        'password_user',
        'remember_token',
    ];
    protected $cast=[
        'gender_user'=>'boolean',
        'birth_user'=>'date',
    ];

    public function auth(){
        return $this->belongsTo('App\Models\Authority','auth_user','id_auth');
    }
    public function hasAuth($auth){
        return $this->auth()->where('name_auth',$auth)->first();
    }
    public function scopeID($query,Request $request){
        if($request->name_user!=""){
            $query->where('id_user', $request->name_user);
        }
        return $query;
    }
    public function scopeName($query,Request $request){
        if($request->name_user!=""){
            $query->where('name_user', 'LIKE', '%' . $request->name_user . '%');
        }
        return $query;
    }
    public function scopeAuth($query,Request $request){
        if( $request->auth_user!=""&&$request->auth_user!="0"){
            $query->where('auth_user', $request->auth_user);
        }
        return $query;
    }
    public function getAuthPassword()
    {
        return $this->password_user;
    }
}
