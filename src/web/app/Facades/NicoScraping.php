<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class NicoScraping extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'nico_scraping';
    }


}


