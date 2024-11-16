<?php

namespace Namecheap\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Namecheap extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'namecheap';
    }
}