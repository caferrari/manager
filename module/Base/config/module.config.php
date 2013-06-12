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
            'usuario' => 'Base\Controller\Usuario',
            'cidade' => 'Base\Controller\Cidade',
        ),
    ),
    'acl' => array(
        'base' => array(
            'label' => 'Modulo Base',
            'tip' => 'Modulo principal do sistema',
            'controllers' => array(
                'usuario' => array(
                    'label' => 'Usuários',
                    'tip' => 'Gerênciamento de Usuários',
                    'actions' => array(
                        'listar' => array(
                            'label' => 'Listar',
                            'tip' => 'Listar usuários'
                        ),
                        'adicionar' => array(
                            'label' => 'Adicionar',
                            'tip' => 'Adicionar um novo usuário no sistema'
                        ),
                        'editar' => array(
                            'label' => 'Editar',
                            'tip' => 'Editar um usuário'
                        ),
                        'excluir' => array(
                            'label' => 'Editar',
                            'tip' => 'Excluir usuários'
                        )
                    )
                )
            )
        )
    )
);