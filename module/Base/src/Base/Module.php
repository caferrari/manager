<?php

namespace Base;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\ModuleManager\ModuleManager,
    Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use Base\Auth\Adapter as AuthAdapter;

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
                'base.usuario' => function ($sm) {
                    return new Service\Usuario($sm->get('Doctrine\ORM\EntityManager'));
                },
                'base.cidade' => function ($sm) {
                    return new Service\Cidade($sm->get('Doctrine\ORM\EntityManager'));
                },
                'base.orgao' => function ($sm) {
                    return new Service\Orgao($sm->get('Doctrine\ORM\EntityManager'));
                },
                'base.authadapter' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $aclService = $sm->get('acl.service');
                    return new AuthAdapter($em, $aclService);
                }
            ),
        );
    }


    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'navigation' => function ($sm) {

                    $auth = new AuthenticationService(
                        new SessionStorage('manager_' . md5(getcwd()))
                    );

                    $navigation = $sm->get('Zend\View\Helper\Navigation');
                    if ($identity = $auth->getIdentity()) {
                        $navigation->setAcl($auth->getIdentity()->getAcl())->setRole('user');
                    }

                    return $navigation;
                }
            )
        );
    }

}
