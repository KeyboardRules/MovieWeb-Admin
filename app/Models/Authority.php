<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'tb_authorities';
    protected $primaryKey='id_auth';
    protected $fillable = [
        'name_auth'
    ];
    public function users()
    {
        return $this->hasMany('App\Models\User','auth_user','id_auth');
    }
}
