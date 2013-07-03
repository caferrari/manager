<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => getcwd() . '/module/Application/view/layout/layout.phtml',
            'application/index/index' => getcwd() . '/module/Application/view/application/index/index.phtml',
            'error/404'               => getcwd() . '/module/Application/view/error/404.phtml',
            'error/index'             => getcwd() . '/module/Application/view/error/index.phtml',
        ),
        'template_path_stack' => array(
            getcwd() . '/module/Application/view'
        ),
    )
);
