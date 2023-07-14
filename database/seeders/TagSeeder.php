<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::truncate();

        $tag = new Tag;
        $tag->name = 'etiqueta 1';
        $tag->save();

        $tag = new Tag;
        $tag->name = 'etiqueta 2';
        $tag->save();

        $tag = new Tag;
        $tag->name = 'etiqueta 3';
        $tag->save();

    }
}
