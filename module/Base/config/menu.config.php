<?php

namespace Base;

return array(
    'default' => array(
        'home' =>  array(
            'label' => 'Home',
            'route' => 'home',
            'order' => -1000
        ),
        'cadastros' => array(
            'label' => 'Cadastros',
            'uri' => '#',
            'order' => 0,
            'pages' => array(
                array(
                    'label' => 'Cidades',
                    'route' => 'crud',
                    'controller' => 'cidade',
                    'action' => 'index',
                    'resource' => 'base_cidade_index',
                    'icon' => 'icon-map-marker'
                ),
                array(
                    'label' => 'Órgãos',
                    'route' => 'crud',
                    'controller' => 'orgao',
                    'action' => 'index',
                    'resource' => 'base_orgao_index',
                    'icon' => 'icon-building',
                    'pages' => array(
                        array(
                            'label' => 'Adicionar Órgão',
                            'route' => 'crud',
                            'controller' => 'orgao',
                            'action' => 'novo',
                        ),
                        array(
                            'label' => 'Editar Órgão',
                            'route' => 'crud',
                            'controller' => 'orgao',
                            'action' => 'editar',
                        ),
                        array(
                            'label' => 'Setores',
                            'route' => 'crud',
                            'controller' => 'setor',
                            'action' => 'index',
                            'pages' => array(
                                array(
                                    'label' => 'Adicionar Setor',
                                    'route' => 'crud',
                                    'controller' => 'setor',
                                    'action' => 'novo',
                                ),
                                array(
                                    'label' => 'Editar Setor',
                                    'route' => 'crud',
                                    'controller' => 'setor',
                                    'action' => 'editar',
                                )
                            )
                        )
                    )
                ),
                array(
                    'label' => 'Usuários',
                    'route' => 'crud',
                    'controller' => 'usuario',
                    'action' => 'index',
                    'resource' => 'base_usuario_index',
                    'icon' => 'icon-user',
                    'pages' => array(
                        array(
                            'label' => 'Adicionar Usuário',
                            'route' => 'crud',
                            'controller' => 'usuario',
                            'action' => 'novo',
                        ),
                        array(
                            'label' => 'Editar Usuário',
                            'route' => 'crud',
                            'controller' => 'usuario',
                            'action' => 'editar',
                        ),
                        array(
                            'label' => 'Permissões',
                            'route' => 'acl-usuario'
                        ),
                        array(
                            'label' => 'Configurações',
                            'route' => 'configs'
                        ),
                    )
                )
            )
        )
    ),
);