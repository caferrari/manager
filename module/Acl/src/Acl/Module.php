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

    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        $sharedEvents->attach(
            'Zend\Mvc\Controller\AbstractActionController',
            MvcEvent::EVENT_DISPATCH,
            function ($e) {

                $acl = $e->getApplication()->getServiceManager()->get('acl');

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

                    $auth->getIdentity()->setAcl($acl);

                    if ($auth->getIdentity()->isAdmin()) {
                        $acl->allow('user');
                        return;
                    }

                    $params = $e->getRouteMatch()->getParams();
                    $resource = $e->getTarget()->getResource() . "_{$params['action']}";

                    foreach ($auth->getIdentity()->getPermissions() as $permission) {
                        if ($acl->hasResource($permission)) {
                            $acl->allow('user', $permission);
                        }
                    }

                    if ($acl->isAllowed('user', $resource)) {
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

                    $acl->addResource('base_index_index');
                    $acl->allow('user', 'base_index_index');

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
