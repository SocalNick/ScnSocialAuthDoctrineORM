<?php

namespace ScnSocialAuthDoctrineORM\Options;

use ScnSocialAuth\Options\ModuleOptions as BaseModuleOptions;

class ModuleOptions extends BaseModuleOptions
{
    /**
     * @var string
     */
    protected $userProviderEntityClass = 'ScnSocialAuthDoctrineORM\Entity\UserProvider';
}
