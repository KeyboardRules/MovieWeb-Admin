<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $table = 'tb_visitor';
    protected $primaryKey='id';
    protected $fillable = [
        'ip_address',
        'visited_date'
    ];
}
