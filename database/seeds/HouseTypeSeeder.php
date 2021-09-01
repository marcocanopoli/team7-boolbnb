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
        $houseTypes = [
            'Appartamento',
            'Villa',
            'Stanza singola',
            'Studio',
            'Cottage'
        ];

        foreach ($houseTypes as $type) {
            HouseType::create(['name' => $type]);
        }
    }
}
