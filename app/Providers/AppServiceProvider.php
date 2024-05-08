<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Tag;




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
        if(Schema::hasTable('categories')){
            $categories=Category::all();
            View::share(compact('categories'));//Abbiamo reso condivisibile a tutte le pagine la classe Category
        }
        if(Schema::hasTable('tags')){
            $tags=Tag::all();
            View::share(compact('tags'));//Abbiamo reso condivisibile a tutte le pagine la classe Tag
        }
    }
}
