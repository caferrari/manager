<?php

namespace Application;

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
        ),
        'configs' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route'    => '/preferencias',
                'defaults' => array(
                    'controller' => 'usuario',
                    'action'     => 'configs',
                ),
            ),
        ),
        'acl-usuario' => array(
            'type' => 'Segment',
            'options' => array(
                'route' => '/usuario/:id/acl',
                'defaults' => array(
                    'controller' => 'acl-usuario',
                    'action' => 'index',
                    'id' => null,
                ),
                'constraints' => array(
                    'id' => '[0-9]+',
                )
            ),
        )
    ),
);
