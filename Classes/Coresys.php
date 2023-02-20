<?php

namespace Modules\Coresys\Classes;

use Modules\Coresys\Installers\FileInstaller;
use Nwidart\Modules\FileRepository;
use Nwidart\Modules\Laravel\Module;

class Coresys extends Module
{
    /**
     * @var
     */
    protected mixed $installer;
    protected mixed $repository;

    public function __construct(Container $app, string $name, $path)
    {
        parent::__construct($app, $name, $path);
        $this->installer = $this->app[FileInstaller::class];
    }

    public static function install():string{
        return "This module is installed";
    }
}
