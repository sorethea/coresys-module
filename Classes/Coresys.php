<?php

namespace Modules\Coresys\Classes;

use Illuminate\Foundation\AliasLoader;
use Modules\Coresys\Installers\FileInstaller;
use Nwidart\Modules\FileRepository;
use Nwidart\Modules\Module;

class Coresys extends Module
{
    /**
     * @var
     */
    protected mixed $installer;
    protected mixed $repository;

    public function __construct(Container $app, string $name, $path)
    {
        $this->installer = $this->app[FileInstaller::class];
        parent::__construct($app, $name, $path);
    }

    public static function install():string{
        return "This module is installed";
    }

    public function registerAliases(): void
    {
        $loader = AliasLoader::getInstance();
        foreach ($this->get('aliases', []) as $aliasName => $aliasClass) {
            $loader->alias($aliasName, $aliasClass);
            dd($aliasClass);
        }
    }

    public function registerProviders(): void
    {

    }

    public function getCachedServicesPath(): string
    {

    }
}
