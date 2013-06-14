<?php

namespace Acl;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage,
    Zend\ModuleManager\ModuleManager;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        (new ModuleRouteListener())->attach($e->getApplication()->getEventManager());
    }

    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        $sharedEvents->attach(
            'Zend\Mvc\Controller\AbstractActionController',
            MvcEvent::EVENT_DISPATCH,
            function ($e) {
                $route = $e->getRouteMatch()->getMatchedRouteName();
                if (in_array($route, explode(', ', 'login, logout'))) {
                    return;
                }

                $auth = new AuthenticationService(
                    new SessionStorage('manager_' . md5(getcwd()))
                );

                if (!$auth->hasIdentity()) {
                    return $e->getTarget()->redirect()->toRoute('login');
                } else {

                    if ($auth->getIdentity()->isAdmin()) {
                        return;
                    }

                    $params = $e->getRouteMatch()->getParams();
                    $resource = $e->getTarget()->getResource() . "_{$params['action']}";
                    if ('base_index_index' == $resource) {
                        return;
                    }

                    $userPermissions = $auth->getIdentity()->getPermissions();

                    if (in_array($resource, $userPermissions) ) {
                        return;
                    }

                    return $e->getTarget()->redirect()->toRoute('home');

                }
            },
            100
        );
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
                }
            )
        );
    }

}
