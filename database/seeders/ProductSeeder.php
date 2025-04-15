<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();

        // Create Users (Ensuring Unique Emails)
        for ($i = 0; $i < 10; $i++) {  // Adjust number of users as needed
            $email = $faker->unique()->safeEmail;

            if (!User::where('email', $email)->exists()) {
                User::create([
                    'name' => $faker->name,
                    'email' => $email,
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'), // Default password
                    'remember_token' => \Str::random(10),
                ]);
            }
        }

        // Create Products (Avoiding Duplicate Product Names)
        for ($i = 0; $i < 15; $i++) {
            do {
                $productName = $faker->unique()->word;
            } while (Product::where('product_name', $productName)->exists());

            Product::create([
                'product_name' => $productName,
                'brand' => $faker->word,
                'category' => $faker->word,
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 10, 1000),
                'quantity' => $faker->numberBetween(1, 100),
                'image' => $faker->imageUrl(640, 480, 'products'),
            ]);
        }
    }
}
