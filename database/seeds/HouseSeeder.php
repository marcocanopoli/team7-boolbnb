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

        function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
            $numbers = range($min, $max);
            shuffle($numbers);
            return array_slice($numbers, 0, $quantity);
        }

        $houses = config('newhouses');

        foreach ($houses as $house) {
            $newHouse = new House();
            $newHouse->fill($house);
            $newHouse->save();
            
            $services = UniqueRandomNumbersWithinRange(1, 20, 10);
            $newHouse->services()->attach($services);
        }        
    }
}
