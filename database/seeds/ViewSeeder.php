<?php

use Illuminate\Database\Seeder;
use App\View;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $views = [
            [
                'house_id' => 1,
                'ip_address' => '127.128.1.1'
            ],
            [
                'house_id' => 2,
                'ip_address' => '127.157.32.1'
            ],
            [
                'house_id' => 3,
                'ip_address' => '127.175.1.15'
            ],
            [
                'house_id' => 4,
                'ip_address' => '127.136.5.14'
            ],
            [
                'house_id' => 5,
                'ip_address' => '127.256.23.2'
            ],
        ];

        foreach ($views as $view) {
            $newView = new View();
            $newView->fill($view);
            $newView->save();
        }
    }
}
