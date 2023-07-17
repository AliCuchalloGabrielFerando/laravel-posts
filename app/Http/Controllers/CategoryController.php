<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return view('pages.home',['title'=>"Estas son las publicaciones de la Categoria: {$category->name}",'posts'=> $category->posts()->paginate(1)]);
    }
}
