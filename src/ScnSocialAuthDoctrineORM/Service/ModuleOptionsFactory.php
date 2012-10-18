<?php
/**
 * ScnSocialAuthDoctrineORM Module
 *
 * @category   ScnSocialAuthDoctrineORM
 * @package    ScnSocialAuthDoctrineORM_Service
 */

namespace ScnSocialAuthDoctrineORM\Service;

use ScnSocialAuthDoctrineORM\Options;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @category   ScnSocialAuthDoctrineORM
 * @package    ScnSocialAuthDoctrineORM_Service
 */
class ModuleOptionsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('Configuration');

        return new Options\ModuleOptions(isset($config['scn-social-auth']) ? $config['scn-social-auth'] : array());
    }
}
