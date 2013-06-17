<?php

namespace Base;

return array(
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            )
        )
    ),
    'data-fixture' => array(
        'Base_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
    ),
    'controllers' => array(
        'invokables' => array(
            'index' => 'Base\Controller\Index',
            'usuario' => 'Base\Controller\Usuario',
            'cidade' => 'Base\Controller\Cidade',
            'orgao' => 'Base\Controller\Orgao',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
    'acl' => include 'acl.config.php',
    'navigation' => include 'menu.config.php',
    'router' => include 'router.config.php',
);