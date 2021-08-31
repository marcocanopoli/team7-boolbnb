<?php

use Illuminate\Database\Seeder;
use App\HouseType;

class HouseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $houseType = [
            [
                'house_id' => 1,
                'name' => 'appartamento'
            ],
            [
                'house_id' => 3,
                'name' => 'villa'
            ],
            [
                'house_id' => 2,
                'name' => 'stanza singola'
            ],
            [
                'house_id' => 4,
                'name' => 'studio'
            ],
            [
                'house_id' => 5,
                'name' => 'cottage'
            ]

        ];

        foreach ($houseType as $type) {
            $newType = new HouseType();
            $newType->fill($type);
            $newType->save();
        }
    }
}
