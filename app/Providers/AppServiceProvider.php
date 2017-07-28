<?php

namespace App\Providers;


use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Validator::extend('isValid', function ($attribute, $value, $parameters, $validator)
//        {
//            $request = (new Client())->get('https://www.validator.pizza/email/' . $value);
//            $body = json_decode($request->getBody()->getContents());
//            switch ( $body )
//            {
//                case $body->status == 400:
//                    return false;
//                case !$body->mx:
//                    return false;
//                case $body->disposable:
//                    return false;
//                default:
//                    return true;
//            }
//        }, '該E-mail驗證無效，請重試或更換E-mail');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
