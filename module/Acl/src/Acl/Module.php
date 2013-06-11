<?php

namespace Acl;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\ModuleManager\ModuleManager;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        //$e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
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
                'Acl\\Form\\Role' => function ($sm) {

                    $repository = $sm->get('Doctrine\ORM\EntityManager')
                        ->getRepository('Acl\Entity\Role');

                    return new Form\Role($repository->fetchParents());
                },
                'acl.role' => function ($sm) {
                    return new Service\Role($sm->get('Doctrine\ORM\EntityManager'));
                },
                'acl.resource' => function ($sm) {
                    return new Service\Resource($sm->get('Doctrine\ORM\EntityManager'));
                },
                'acl.privilege' => function ($sm) {
                    return new Service\Privilege($sm->get('Doctrine\ORM\EntityManager'));
                }
            ),
        );
    }

}
