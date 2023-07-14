<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Tag;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','url','body', 'iframe', 'excerpt','published_at','category_id'];
    protected $casts = ['published_at'=>'datetime'];

    public function getRouteKeyName(){
        return 'url';
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function scopePublished(Builder $query){
        $query->whereNotNull('published_at')
        ->where('published_at','<=',Carbon::now())
        ->latest('published_at');
    }

    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map( function($tag)
        {
           return Tag::find($tag) ? $tag : Tag::create(['name'=>$tag])->id;
        });

       return $this->tags()->sync($tagIds);
    }
    
  /*  protected function title():attribute
    {
        $url = Str::slug($this->title);
        $duplicateUrlCount = Post::where('url','LIKE',"{$url}%")->count();
        if ($duplicateUrlCount)
        {
            $url = $url . "-" . ++$duplicateUrlCount;
        }else{

        }
        return Attribute::make(
            set: fn(string $title)=>[
                'title'=>$title,
                'url'=>Str::slug($title)
            ]
            );
    }*/
    protected function publishedAt():attribute
    {
        return Attribute::make(
            set: fn(string $published_at)=> $published_at ? Carbon::parse($published_at) : null,
        );
    }

    protected function categoryId():attribute
    {
        return Attribute::make(
            set: fn(string $category)=> Category::find($category) ? $category : Category::create(['name'=>$category])->id
        );
    }
}
