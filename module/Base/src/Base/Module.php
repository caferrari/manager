<?php

namespace Base;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\ModuleManager\ModuleManager,
    Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;;

use Base\Auth\Adapter as AuthAdapter;

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
                'base.usuario' => function ($sm) {
                    return new Service\Usuario($sm->get('Doctrine\ORM\EntityManager'));
                },
                'base.cidade' => function ($sm) {
                    return new Service\Cidade($sm->get('Doctrine\ORM\EntityManager'));
                },
                'base.authadapter' => function ($sm) {
                    return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
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
