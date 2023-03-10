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

    public static function getType($name): string{
        $module = \Module::find($name);
        return $module->get("type")??'module';
    }

    public static function isInstalled($name): bool{
        $module = \Module::find($name);
        return $module->get("installed")??false;
    }

    public static function install($name): void {
        try{
            $module = \Module::find($name);
            if(!empty($module)){
                \DB::beginTransaction();
                \Artisan::call("module:migrate-refresh ".$name);
                \Artisan::call("module:seed ".$name);
                $module->enable();
                $module->json()->set("installed",true)->save();
                \DB::commit();
            }
        }catch (\Throwable $e){
            \DB::rollBack();
        }
    }

    public static function uninstall($name): void
    {
        try{
            $module = \Module::find($name);
            if(!empty($module)){
                \DB::beginTransaction();
                \Artisan::call("module:migrate-rollback ".$name);
                $module->disable();
                $module->json()->set("installed",false)->save();
                \DB::commit();
            }
        }catch (\Throwable $e){
            \DB::rollBack();
        }
    }
}
