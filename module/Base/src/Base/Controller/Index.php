<?php

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class Index extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
