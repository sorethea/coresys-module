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

    public static function install($name): int {

        try{
            $module = \Module::find($name);
            \DB::beginTransaction();
            \Artisan::call("module:migrate-refresh ".$name);
            \Artisan::call("module:seed ".$name);
            $module->enable();
            \DB::commit();
            return $module->isEnable();
        }catch (\Throwable $e){
            \DB::rollBack();
            return $e->getCode();
        }
    }

    public static function uninstall($name): int
    {
        try{
            $module = \Module::find($name);
            \DB::beginTransaction();
            \Artisan::call("module:migrate-rollback ".$name);
            $module->disable();
            \DB::commit();
            return $module->isEnable();
        }catch (\Throwable $e){
            \DB::rollBack();
            return $e->getCode();
        }
    }

}
