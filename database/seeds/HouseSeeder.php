<?php

use Illuminate\Database\Seeder;
use App\House;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $houses = config('houses');

        foreach ($houses as $house) {
            $newHouse = new House();
            $newHouse->fill($house);
            $newHouse->save();
        }
    }
}
