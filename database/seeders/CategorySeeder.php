<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Category::truncate();
        
        $category = new Category;
        $category->name = "Categoria 1";
      //  $category->url = "Categoria-1";
        $category->save();

        $category = new Category;
        $category->name = "Categoria 2";
       // $category->url = "Categoria-2";
        $category->save();

    }
}
