<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(request(),[
            'photo'=>'required|image|max:2048'
        ]);
        
        $post->photos()->create([
            'url'=> Storage::url(request()->file('photo')->store('post','public'))
        ]);
        return $post->photos;
    }
    public function destroy(Photo $photo)
    {
       
        $photo->delete();

        return back()->with('flash','Foto Eliminada');
    }
}
