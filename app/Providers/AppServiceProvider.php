<?php

namespace App\Providers;

// use TCG\Voyager\Facades\Voyager;
// use App\FormFields\ProductFormFields;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Voyager::addFormField(ProductFormFields::class);
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


    }
}
