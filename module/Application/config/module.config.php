<?php

namespace Application;

return array(
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Application/Entity',
                    __DIR__ . '/../src/Acl/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application\Entity' => 'Application_driver',
                    'Acl\Entity' => 'Application_driver'
                ),
            )
        )
    ),
    'data-fixture' => array(
        'Application_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
    ),
    'controllers' => array(
        'invokables' => array(
            'acl-usuario' => 'Acl\Controller\Usuario',
            'index' => 'Application\Controller\Index',
            'usuario' => 'Application\Controller\Usuario',
            'cidade' => 'Application\Controller\Cidade',
            'orgao' => 'Application\Controller\Orgao',
            'setor' => 'Application\Controller\Setor',
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
