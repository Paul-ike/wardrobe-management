<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::truncate();
        
        Category::insert([
            ['name' => 'Shirts'],
            ['name' => 'Pants'],
            ['name' => 'Shoes'],
        ]);
    }
}

