<?php

use Illuminate\Database\Seeder;
use App\Promotion;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promotions = [
            [
                'name' => 'Bronze',
                'price' => 2.99,
                'duration' => 1
            ],
            [
                'name' => 'Silver',
                'price' => 5.99,
                'duration' => 3
            ],
            [
                'name' => 'Gold',
                'price' => 9.99,
                'duration' => 6
            ]
            
        ];

        foreach ($promotions as $promotion) {
            $newPromotion = new Promotion();
            $newPromotion->fill($promotion);
            $newPromotion->save();
        }
    }
}
