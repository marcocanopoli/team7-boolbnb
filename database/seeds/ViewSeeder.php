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
                'ip_address' => '127.128.1.1'
            ],
            [
                'house_id' => 3,
                'ip_address' => '127.128.1.1'
            ],
            [
                'house_id' => 4,
                'ip_address' => '127.128.1.1'
            ],
            [
                'house_id' => 5,
                'ip_address' => '127.128.1.1'
            ],
        ];

        foreach ($views as $view) {
            $newView = new View();
            $newView->fill($view);
            $newView->save();
        }
    }
}
