<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Wedding', 'description' => 'Beautiful arrangements for your special day'],
            ['name' => 'Birthday', 'description' => 'Celebrate with colorful birthday bouquets'],
            ['name' => 'Anniversary', 'description' => 'Express your love with romantic flowers'],
            ['name' => 'Sympathy', 'description' => 'Thoughtful arrangements for difficult times'],
            ['name' => 'Get Well', 'description' => 'Brighten someone\'s day with cheerful flowers'],
            ['name' => 'Just Because', 'description' => 'No special occasion needed'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}