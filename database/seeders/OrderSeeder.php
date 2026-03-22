<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Flower;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::where('role', 'customer')->get();
        $flowers = Flower::all();
        $statuses = ['pending', 'processing', 'delivered', 'cancelled'];

        if ($customers->isEmpty() || $flowers->isEmpty()) {
            return;
        }

        // Create 20 sample orders spread over last 6 months
        for ($i = 0; $i < 20; $i++) {
            $customer = $customers->random();
            $orderDate = now()->subDays(rand(1, 180));
            $status = $statuses[array_rand($statuses)];

            $orderFlowers = $flowers->random(rand(1, 3));
            $total = 0;

            $order = Order::create([
                'user_id' => $customer->id,
                'order_number' => Order::generateOrderNumber(),
                'total' => 0,
                'status' => $status,
                'customer_name' => $customer->name,
                'customer_phone' => '09' . rand(100000000, 999999999),
                'delivery_address' => fake()->address(),
                'delivery_date' => $orderDate->copy()->addDays(rand(1, 5)),
                'message' => rand(0, 1) ? fake()->sentence() : null,
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ]);

            foreach ($orderFlowers as $flower) {
                $qty = rand(1, 3);
                $price = $flower->price;
                $total += $price * $qty;

                OrderItem::create([
                    'order_id' => $order->id,
                    'flower_id' => $flower->id,
                    'flower_name' => $flower->name,
                    'price' => $price,
                    'quantity' => $qty,
                ]);
            }

            $order->update(['total' => $total]);
        }
    }
}
