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
    'router' => array(
        'routes' => array(
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
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            getcwd() . '/module/Acl/view'
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'acl-usuario' => 'Acl\Controller\Usuario'
        ),
    ),
    'acl' => array(
        'acl' => array(
            'label' => 'Controle de Acesso',
            'tip' => 'Modulo principal do sistema',
            'controllers' => array(
                'usuario' => array(
                    'label' => 'Usuários',
                    'tip' => 'Gerênciamento de Permissões de Usuários',
                    'actions' => array(
                        'gerenciar' => array(
                            'label' => 'Listar',
                            'tip' => 'Definir permissões de usuários'
                        )
                    )
                )
            )
        )
    )
);