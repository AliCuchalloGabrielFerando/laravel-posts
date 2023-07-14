<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    public function index(){

        $posts = Post::all();

        return view('admin.posts.index',compact('posts'));
    }
    
    public function store(Request $request)
    {
        //|unique:posts
        $this->validate($request,['title'=>'required|min:3']);

        $post = Post::create($request->only('title'));

        return redirect()->route('admin.posts.edit',$post);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit',compact('categories','tags','post'));
    }
    public function update(Post $post,PostRequest $request)
    {
        $post->update($request->all());

        $post->syncTags($request->get('tags'));

        return redirect()->route('admin.posts.edit',$post)->with('flash','tu publicacion ha sido guardada');
    }

    public function destroy(Post $post)
    {
        
        $post->delete();

        return redirect()->route('admin.posts.index',$post)->with('flash','La publicacion ha sido eliminada');
    }
}
