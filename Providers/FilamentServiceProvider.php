<?php

namespace Modules\Coresys\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Modules\Coresys\Filament\Pages\CoresysPage;

class FilamentServiceProvider extends PluginServiceProvider
{
    public function isEnabled(): bool{
        $module = \Module::find('coresys');
        return $module->isEnabled();
    }
    protected array $pages = [];
    protected array $resources =[];
    public function configurePackage(Package $package): void
    {
        $package->name('coresys');
    }

    public function getResources(): array
    {
        return ($this->isEnabled())?$this->resources:[];
    }

    public function getPages(): array
    {
        return ($this->isEnabled())?$this->pages:[];
    }

    public function boot()
    {
        Filament::serving(function (){
            if(config('coresys.navigation.enabled'))
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label(config('coresys.navigation.name'))
            ]);
        });
        return parent::boot();
    }
}
