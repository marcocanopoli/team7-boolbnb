<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(HouseTypeSeeder::class);
        $this->call(HouseSeeder::class);
        $this->call(PhotoSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(PromotionSeeder::class);
        // $this->call(ViewSeeder::class);
    }
}
