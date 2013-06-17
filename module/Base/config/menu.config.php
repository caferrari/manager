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
                    'resource' => 'base_cidade_index'
                ),
                array(
                    'label' => 'Órgãos',
                    'route' => 'crud',
                    'controller' => 'orgao',
                    'action' => 'index',
                    'resource' => 'base_orgao_index'
                ),
                array(
                    'label' => 'Usuários',
                    'route' => 'crud',
                    'controller' => 'usuario',
                    'action' => 'index',
                    'resource' => 'base_usuario_index'
                )
            )
        )
    ),
);