<?php

namespace Base;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\ModuleManager\ModuleManager;

use Base\Auth\Adapter as AuthAdapter;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        (new ModuleRouteListener())->attach($e->getApplication()->getEventManager());
    }

    public function init(ModuleManager $moduleManager)
    {

    }

    public function getConfig()
    {
        return include __DIR__ . '../../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'base.usuario' => function ($sm) {
                    return new Service\Usuario($sm->get('Doctrine\ORM\EntityManager'));
                },
                'base.cidade' => function ($sm) {
                    return new Service\Cidade($sm->get('Doctrine\ORM\EntityManager'));
                },
                'base.authadapter' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $aclService = $sm->get('acl.service');
                    return new AuthAdapter($em, $aclService);
                }
            ),
        );
    }

}
