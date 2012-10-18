<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'ScnSocialAuth-UserProviderMapper' => 'ScnSocialAuthDoctrineORM\Service\UserProviderMapperFactory',
        ),
    ),
);