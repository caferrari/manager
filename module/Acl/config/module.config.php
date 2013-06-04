<?php

namespace Acl;

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
        'Acl_fixture' => __DIR__ . '/../src/Acl/Fixture',
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            getcwd() . '/module/Acl/view'
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'role' => 'Acl\Controller\Role'
        ),
    )
);