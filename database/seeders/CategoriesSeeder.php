<?php

namespace Database\Seeders;

use App\Models\v1\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::truncate();
        $json = File::get('database/categories.json');
        $categories = json_decode($json);
        foreach ($categories as $key => $value) {
            Category::create([
                "title" => $value->name,
                "slug" => $value->slug,
            ]);
        }
    }
}
