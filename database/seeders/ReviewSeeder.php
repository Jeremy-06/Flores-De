<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Flower;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::where('role', 'customer')->get();
        $flowers = Flower::all();

        if ($customers->isEmpty() || $flowers->isEmpty()) {
            return;
        }

        $comments = [
            5 => [
                'Absolutely beautiful! The flowers were fresh and arrived on time.',
                'Amazing arrangement! My wife loved it. Will order again!',
                'Perfect bouquet, exceeded expectations. Highly recommended!',
                'Stunning flowers! Great quality and fast delivery.',
            ],
            4 => [
                'Very nice flowers, just a bit smaller than expected.',
                'Great quality! Delivery was a day late though.',
                'Beautiful arrangement, would order again.',
                'Lovely flowers, good value for money.',
            ],
            3 => [
                'Decent flowers but nothing special.',
                'Okay quality, expected a bit more for the price.',
                'Average arrangement, some flowers were starting to wilt.',
            ],
            2 => [
                'Flowers arrived late and some were already wilting.',
                'Not what I expected from the photos.',
            ],
            1 => [
                'Very disappointed. Flowers were dead on arrival.',
            ],
        ];

        foreach ($customers as $customer) {
            // Each customer reviews 2-4 random flowers
            $reviewFlowers = $flowers->random(min(rand(2, 4), $flowers->count()));

            foreach ($reviewFlowers as $flower) {
                $rating = collect([5, 5, 5, 4, 4, 4, 3, 3, 2])->random();
                $commentPool = $comments[$rating];

                Review::create([
                    'user_id' => $customer->id,
                    'flower_id' => $flower->id,
                    'rating' => $rating,
                    'comment' => $commentPool[array_rand($commentPool)],
                    'created_at' => now()->subDays(rand(1, 90)),
                ]);
            }
        }
    }
}
