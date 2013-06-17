<?php

namespace Base;

return array(
    'routes' => array(
        'home' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route'    => '/',
                'defaults' => array(
                    'controller' => 'index',
                    'action'     => 'index',
                ),
            ),
        ),
        'login' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route'    => '/login',
                'defaults' => array(
                    'controller' => 'usuario',
                    'action'     => 'login',
                ),
            ),
        ),
        'logout' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route'    => '/logout',
                'defaults' => array(
                    'controller' => 'usuario',
                    'action'     => 'logout',
                ),
            ),
        )
    ),
);