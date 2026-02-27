<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Flower;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FlowerSeeder extends Seeder
{
    public function run(): void
    {
        $flowers = [
            ['name' => 'Red Rose Bouquet', 'category' => 'Anniversary', 'price' => 49.99, 'description' => 'Classic red roses symbolizing love and passion. Perfect for anniversaries and romantic occasions.'],
            ['name' => 'White Lily Arrangement', 'category' => 'Sympathy', 'price' => 65.00, 'description' => 'Elegant white lilies representing peace and purity.'],
            ['name' => 'Sunflower Delight', 'category' => 'Birthday', 'price' => 35.99, 'description' => 'Bright and cheerful sunflowers to bring joy to any birthday.'],
            ['name' => 'Mixed Tulip Bunch', 'category' => 'Just Because', 'price' => 29.99, 'description' => 'Colorful tulips in various shades to brighten any day.'],
            ['name' => 'Bridal White Roses', 'category' => 'Wedding', 'price' => 89.99, 'description' => 'Stunning white roses for the perfect wedding bouquet.'],
            ['name' => 'Orchid Elegance', 'category' => 'Anniversary', 'price' => 75.00, 'description' => 'Exotic orchids representing luxury and beauty.'],
            ['name' => 'Daisy Sunshine Basket', 'category' => 'Get Well', 'price' => 32.99, 'description' => 'Happy daisies to wish someone a speedy recovery.'],
            ['name' => 'Pink Carnation Love', 'category' => 'Birthday', 'price' => 28.99, 'description' => 'Sweet pink carnations perfect for birthday celebrations.'],
            ['name' => 'Lavender Dreams', 'category' => 'Just Because', 'price' => 42.99, 'description' => 'Calming lavender arrangement for relaxation.'],
            ['name' => 'Tropical Paradise', 'category' => 'Birthday', 'price' => 55.99, 'description' => 'Exotic tropical flowers for a vibrant celebration.'],
            ['name' => 'Garden Mix Bouquet', 'category' => 'Just Because', 'price' => 38.99, 'description' => 'A beautiful mix of seasonal garden flowers.'],
            ['name' => 'Romantic Peony', 'category' => 'Wedding', 'price' => 95.00, 'description' => 'Luxurious peonies for the most romantic occasions.'],
        ];

        foreach ($flowers as $flower) {
            $category = Category::where('name', $flower['category'])->first();
            
            Flower::create([
                'category_id' => $category->id,
                'name' => $flower['name'],
                'slug' => Str::slug($flower['name']),
                'description' => $flower['description'],
                'price' => $flower['price'],
                'stock' => rand(10, 50),
                'available' => true,
            ]);
        }
    }
}