<?php
return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'Base',
        'Crud'
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{test}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
            './tests/vendor'
        ),
    ),
);
