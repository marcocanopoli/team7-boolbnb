<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            'Cucina',
            'Aria condizionata',
            'Asciugatrice',
            'Colazione inclusa',
            'Ferro da stiro',
            'Wi-Fi',
            'Culla',
            'Rilevatore di fumo',
            'Kit cortesia',
            'Riscaldamento',
            'Lavatrice',
            'Camino',
            'TV',
            'Asciugacapelli',
            'Vista mare',
            'Vista montagna',
            'Vista lago',
            'Animali ammessi',
            'Cancellazione gratuita',
            'Posto auto'
        ];

        // $services = [
        //     [
        //         'icon' => 
        //     ],
        // ]

        foreach ($services as $service) {
            $newService = new Service();
            $newService->name = $service;
            $newService->save();
        }
    }
}
