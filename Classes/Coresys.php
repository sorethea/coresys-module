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

    public static function install($name): void {
        $module = \Module::find($name);
        try{
            \DB::beginTransaction();
            \Artisan::call("module:migrate-fresh ".$name);
            \Artisan::call("module:seed ".$name);
            $module->enable();
            \DB::commit();
        }catch (\Exception $exception){
            \DB::rollBack();
            error_log($exception->getMessage());
        }
    }

    public static function uninstall($name): void {
        $module = \Module::find($name);
        try{
            \DB::beginTransaction();
            \Artisan::call("module:migrate-rollback ".$name);
            $module->disable();
            \DB::commit();
        }catch (\Exception $exception){
            \DB::rollBack();
            error_log($exception->getMessage());
        }
    }

}
