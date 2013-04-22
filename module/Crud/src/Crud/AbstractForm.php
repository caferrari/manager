<?php

namespace Crud;

use Zend\Form\Form;

abstract class AbstractForm extends Form
{

    use \Crud\GetInputFilter;

}