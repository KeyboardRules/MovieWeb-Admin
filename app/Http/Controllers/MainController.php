<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Blog;
use App\Models\User;
use App\Models\Visitor;

class MainController extends Controller
{
    function MainView(){
        return view('admin.views.main',
        ['visitors'=>Visitor::all()->count(),'users'=>User::all()->count(),'movies'=>Movie::all()->count(),'blogs'=>Blog::all()->count()]);
    }
}
