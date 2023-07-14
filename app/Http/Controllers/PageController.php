<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PageController extends Controller
{
    public function home(){
        $posts = Post::published()->paginate(1);
    return view('welcome',['posts'=>$posts]);
    }
}
