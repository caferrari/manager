<?php

namespace Test;

use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\Mvc\MvcEvent;

class ModelTestCase extends AbstractTestCase
{

    protected $service = 'Doctrine\ORM\EntityManager';

    /**
     * @var EntityManager
     */
    protected $em;

    public function tearDown()
    {
        parent::tearDown();
    }

    public function getEm()
    {
        if (isset($this->em)) {
            return $this->em;

        }
        return $this->em = $this->application->getServiceManager()->get($this->service);
    }
}