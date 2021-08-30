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
        $photos = config('images');

        foreach ($photos as $photo) {
            $newPhoto = new Photo();
            $newPhoto->fill($photo);
            $newPhoto->save();
        }
    }
}
