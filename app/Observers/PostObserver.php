<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;
class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $urlSimple = Str::slug($post->title);
        $urlUnique = Str::slug($post->title) . "-{$post->id}";

        $post->url = Post::where('url',$urlSimple)->exists() ?  $urlUnique: $urlSimple;

        $post->save();
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $post->tags()->detach();
        $post->photos->each->delete();
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
