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
    //protected mixed $repository;

    public function boot(): void
    {
        //$this->repository = $this->app[FileRepository::class];
        $this->installer = $this->app[FileInstaller::class];
        parent::boot();
    }
}
