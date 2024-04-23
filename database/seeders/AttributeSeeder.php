<?php

namespace Database\Seeders;

use App\Models\v1\ProductVariation;
use Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/variation.json');
        $categories = json_decode($json);
        foreach ($categories as $key => $value) {
            ProductVariation::create([
                "value" => $value->value,
                "meta" => $value->meta,
                'attribute'=>$value->attribute
            ]);
        }
    }
}
