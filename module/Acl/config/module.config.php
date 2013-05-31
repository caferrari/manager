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
    'router' => array(
        'routes' => array(
            'acl-crud' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => 'acl/:controller[/:action][?id=:id][?uf=:uf]',
                    'defaults' => array(
                        'controller' => 'roles',
                        'action' => 'index',
                        'id' => null,
                        'uf' => null
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                        'uf' => '[A-Z]{2}'
                    )
                ),
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'roles' => 'Acl\Controller\Roles'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'bootstrapRow' => 'Common\Helper\BootstrapRow',
            'FlashMessages' => 'Common\View\Helper\FlashMessages',
        )
    )
);