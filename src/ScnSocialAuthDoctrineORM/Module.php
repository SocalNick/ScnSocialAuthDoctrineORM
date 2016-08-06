<?php

namespace ScnSocialAuthDoctrineORM;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;

class Module implements ConfigProviderInterface
{
    public function onBootstrap($e)
    {
        $app     = $e->getParam('application');
        $sm      = $app->getServiceManager();
        $config = $sm->get('Config');

        // Enable default entities
        if ( ! isset($config['scn-social-auth']['enable_default_entities'])
            || $config['scn-social-auth']['enable_default_entities']) {
            $chain = $sm->get('doctrine.driver.orm_default');
            $chain->addDriver(new AnnotationDriver(
                new AnnotationReader(),
                array(__DIR__ . '/Entity')
            ), 'ScnSocialAuthDoctrineORM\Entity');
        }
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }
}
