<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'tb_blogs';
    protected $primaryKey='id_blog';
    protected $fillable = [
        'title_blog',
        'content_blog',
        'status_blog',
        'author_blog'
    ];
}
