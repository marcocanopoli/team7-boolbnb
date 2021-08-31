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
            'cucina',
            'aria condizionata',
            'asciugatrice',
            'colazione',
            'ferro da stiro',
            'wifi',
            'culla',
            'rilevatore fumo',
            'kit cortesia',
            'riscaldamento',
            'lavatrice',
            'camino',
            'tv',
            'asciugacapelli',
            'vista mare',
            'vista montagna',
            'vista lago',
            'animali ammessi',
            'cancellazione gratuita',
            'posto auto'
        ];

        foreach ($services as $service) {
            $newService = new Service();
            $newService->name = $service;
            $newService->save();
        }
    }
}
