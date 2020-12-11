<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'tb_reviews';
    protected $primaryKey='id_review';
    protected $fillable = [
        'score_review',
        'content_review',
        'created_at',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User','person_review','id_user');
    }
    public function movie(){
        return $this->belongsTo('App\Models\Movie','movie_review','id_movie');
    }
}
