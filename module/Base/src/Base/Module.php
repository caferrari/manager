<?php

namespace Base;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        //$e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
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
                }
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'flashMessage' => function ($sm) {
                    $flashmessenger = $sm->getServiceLocator()
                        ->get('ControllerPluginManager')
                        ->get('flashmessenger');

                    $message = new \Common\Helper\FlashMessages;
                    $message->setFlashMessager($flashmessenger);
                    return $message ;
                }
            ),
        );
    }
}
