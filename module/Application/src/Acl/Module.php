<?php

namespace Acl;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage,
    Zend\ModuleManager\ModuleManager,
    Zend\Permissions\Acl\Acl;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        (new ModuleRouteListener())->attach($e->getApplication()->getEventManager());
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
                'acl.usuario' => function ($sm) {
                    return new Service\Usuario($sm->get('Doctrine\ORM\EntityManager'));
                },
                'acl.service' => function ($sm) {
                    return new Service\Acl($sm->get('Doctrine\ORM\EntityManager'));
                },
                'acl' => function ($sm) {

                    $acl = new Acl();
                    $acl->addRole('user');

                    $aclConfig = $sm->get('Config')['acl'];

                    foreach ($aclConfig as $namespace => $controllers) {
                        foreach ($controllers['controllers'] as $controller => $actions) {
                            foreach ($actions['actions'] as $action => $data) {
                                foreach (explode(',', $action) as $action) {
                                    $resource = "{$namespace}_{$controller}_{$action}";
                                    $acl->addResource($resource);
                                    $acl->deny('user', $resource);
                                }

                            }
                        }
                    }

                    $acl->addResource('application_index_index');
                    $acl->allow('user', 'application_index_index');

                    return $acl;

                },
                'Zend\Authentication\AuthenticationService' => function ($sm) {
                    return new AuthenticationService(
                        new SessionStorage('manager_' . md5(getcwd()))
                    );
                }
            )
        );
    }

}
