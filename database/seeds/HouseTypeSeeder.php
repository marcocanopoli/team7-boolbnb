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
                'name' => 'appartamento'
            ],
            [
                'name' => 'villa'
            ],
            [

                'name' => 'stanza singola'
            ],
            [
                'name' => 'studio'
            ],
            [
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
