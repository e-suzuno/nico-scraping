<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Tag extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tag';
    }


}


