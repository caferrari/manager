<?php

namespace Test;

use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfig;

abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    public function setup()
    {
        parent::setup();

        $pathDir = getcwd()."/";
        $config = include $pathDir.'config/test.config.php';

        $this->serviceManager = new ServiceManager(
            new ServiceManagerConfig(
                isset($config['service_manager']) ? $config['service_manager'] : array()
            )
        );
        $this->serviceManager->setService('ApplicationConfig', $config);
        $this->serviceManager->setFactory('ServiceListener', 'Zend\Mvc\Service\ServiceListenerFactory');

        $moduleManager = $this->serviceManager->get('ModuleManager');
        $moduleManager->loadModules();

        $this->application = $this->serviceManager->get('Application');

        exec($pathDir . 'tests/vendor/bin/doctrine-module orm:schema-tool:drop --force');
        exec($pathDir . 'tests/vendor/bin/doctrine-module orm:schema-tool:create');
    }

    public function tearDown()
    {
        parent::tearDown();

    }

}