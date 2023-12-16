<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Validator::extend('at_least_one_selected', function ($attribute, $value, $parameters, $validator) {
            foreach ($parameters as $checkbox) {
                if ($validator->getData()[$checkbox]) {
                    return true;
                }
            }

            return false;
        });

        Validator::replacer('at_least_one_selected', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':values', implode(', ', $parameters), $message);
        });
    }
}
