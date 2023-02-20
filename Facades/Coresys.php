<?php

namespace Modules\Coresys\Facades;

class Coresys extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'coresys';
    }
}
