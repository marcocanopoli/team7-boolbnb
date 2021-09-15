<?php

use Illuminate\Database\Seeder;
use App\Photo;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $housesPhotos = config('house_photos');

        foreach ($housesPhotos as $index => $singleHousePhotos) {
            foreach ($singleHousePhotos as $photo) {
                $newPhoto = new Photo();
                $newPhoto->house_id = $index + 1;
                $newPhoto->path = $photo . '.jpg';
                $newPhoto->save();               
            }
        }
    }
}
