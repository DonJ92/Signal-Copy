<?php

namespace App\Providers;

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
        //
        Validator::extend('uniqueBrokerAccId', function ($attribute, $value, $parameters, $validator) {
            $count = \DB::table('tbl_account_list')->where('account_id', $value)
                ->where('broker_id', $parameters[0])
                ->when($parameters, function($query) use ($parameters) {
                    if (isset($parameters[1]))
                        return $query->where('id', '<>', $parameters[1]);
                    
                    return $query;
                })->count();
            // dd($parameters);
            return $count === 0;
        });

        Validator::extend('existsBrokerAccId', function ($attribute, $value, $parameters, $validator) {
            
            $count = \DB::table('tbl_account_list')->where('account_id', $value)
                ->where('broker_id', $parameters[0])
                ->count();
        
            return $count > 0;
        });
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
