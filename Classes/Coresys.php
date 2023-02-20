<?php

namespace Modules\Coresys\Classes;

use Nwidart\Modules\Module;

class Coresys
{
    public static function all(): array{
        return \Module::all();
    }

    public static function find($name): Module{
        return \Module::find($name);
    }
}
