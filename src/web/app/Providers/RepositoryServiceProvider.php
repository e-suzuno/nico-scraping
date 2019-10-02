<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {

        $this->app->bind(
            \App\Repositories\NicoComic\NicoComicRepositoryInterface::class,
            \App\Repositories\NicoComic\NicoComicRepository::class
        );
        $this->app->bind(
            \App\Repositories\Tag\TagRepositoryInterface::class,
            \App\Repositories\Tag\TagRepository::class
        );


    }

    public function boot()
    {
    }
}
