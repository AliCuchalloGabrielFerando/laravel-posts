<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('public')->deleteDirectory('post');
        Post::truncate();
        $post = new Post;
        $post->title = 'mi primer post';
        $post->excerpt = 'extracto de mi primer post';
        $post->body = '<p>Contenido de mi primer Post</p>';
        $post->published_at = Carbon::now()->subDays(10);
        $post->category_id = 1;
        $post->save();

        $post = new Post;
        $post->title = 'mi segundo post';
        $post->excerpt = 'extracto de mi segundo post';
        $post->body = '<p>Contenido de mi segundo Post</p>';
        $post->published_at = Carbon::now()->subDays(5);
        $post->category_id = 2;
        $post->save();
        $post = new Post;
        $post->title = 'mi tercer post';
        $post->excerpt = 'extracto de mi tercer post';
        $post->body = '<p>Contenido de mi tercer Post</p>';
        $post->published_at = Carbon::now()->subDays(3);
        $post->category_id = 1;
        $post->save();

        $post = new Post;
        $post->title = 'mi cuarta post';
        $post->excerpt = 'extracto de mi cuarta post';
        $post->body = '<p>Contenido de mi cuarta Post</p>';
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id = 2;
        $post->save();
    }
}
