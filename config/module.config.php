<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'ScnSocialAuth-Entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/ScnSocialAuthDoctrineORM/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'ScnSocialAuthDoctrineORM\Entity'  => 'ScnSocialAuth-Entity'
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'ScnSocialAuth-ModuleOptions' => 'ScnSocialAuthDoctrineORM\Service\ModuleOptionsFactory',
            'ScnSocialAuth-UserProviderMapper' => 'ScnSocialAuthDoctrineORM\Service\UserProviderMapperFactory',
        ),
    ),
);