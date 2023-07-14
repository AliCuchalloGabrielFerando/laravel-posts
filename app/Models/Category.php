<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    
    public function getRouteKeyName()
    {
        return 'url';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    protected function name():Attribute
    {
        return Attribute::make(
            get: fn (string $name,) => $name,
            set: fn (string $name) => [
                'name'=>$name,
               'url'=> Str::slug($name)
               ]
        );
    }
}
