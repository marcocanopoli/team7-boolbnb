<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $gateway = new \Braintree\Gateway(
            [   
                'environment' => 'sandbox',
                'merchantId' => '5ntrjx7rbdmffpyf',
                'publicKey' => 'rkg3x3tqbq392nhm',
                'privateKey' => '68963c670d11b518b04a0e860143ffbd'
            ]);
    }
}
