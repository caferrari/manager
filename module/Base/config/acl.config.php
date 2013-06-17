<?php

namespace Base;

return array(
    'base' => array(
        'label' => 'Modulo Base',
        'tip' => 'Modulo principal do sistema',
        'controllers' => array(
            'usuario' => array(
                'label' => 'Usuários',
                'tip' => 'Gerênciamento de Usuários',
                'actions' => array(
                    'index' => array(
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
            ),
            'cidade' => array(
                'label' => 'Cidades',
                'tip' => 'Gerênciamento de Cidades',
                'actions' => array(
                    'index' => array(
                        'label' => 'Listar',
                        'tip' => 'Listar cidades'
                    ),
                    'adicionar' => array(
                        'label' => 'Adicionar',
                        'tip' => 'Adicionar uma nova cidade no sistema'
                    ),
                    'editar' => array(
                        'label' => 'Editar',
                        'tip' => 'Editar cidade'
                    ),
                    'excluir' => array(
                        'label' => 'Editar',
                        'tip' => 'Excluir cidade'
                    )
                )
            ),
            'orgao' => array(
                'label' => 'Órgãos',
                'tip' => 'Gerênciamento de Órgãos',
                'actions' => array(
                    'index' => array(
                        'label' => 'Listar',
                        'tip' => 'Listar órgãos'
                    ),
                    'adicionar' => array(
                        'label' => 'Adicionar',
                        'tip' => 'Adicionar um novo órgão'
                    ),
                    'editar' => array(
                        'label' => 'Editar',
                        'tip' => 'Editar órgão'
                    ),
                    'excluir' => array(
                        'label' => 'Editar',
                        'tip' => 'Excluir órgão'
                    )
                )
            )
        )
    )
);