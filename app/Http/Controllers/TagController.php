<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
class TagController extends Controller
{
    public function show(Tag $tag)
    {
        return view('welcome',['title'=>"Estas son las publicaciones del Tag: {$tag->name}",'posts'=> $tag->posts()->paginate(1)]);
    }
}
