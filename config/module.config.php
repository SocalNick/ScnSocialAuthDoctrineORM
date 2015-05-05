<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'ScnSocialAuth-ModuleOptions' => 'ScnSocialAuthDoctrineORM\Service\ModuleOptionsFactory',
            'ScnSocialAuth-UserProviderMapper' => 'ScnSocialAuthDoctrineORM\Service\UserProviderMapperFactory',
        ),
    ),
);