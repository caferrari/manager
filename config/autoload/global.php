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
    'router' => array(
        'routes' => array(
            'crud' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/:controller[/:action][?id=:id]',
                    'defaults' => array(
                        'action' => 'index',
                        'id' => null,
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    )
                ),
                'priority' => 0
            ),
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Base\Controller',
                        'controller' => 'Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller' => 'usuario',
                        'action'     => 'login',
                    ),
                ),
            ),
            'logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        'controller' => 'usuario',
                        'action'     => 'logout',
                    ),
                ),
            )
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Base\Controller\Index' => 'Base\Controller\Index',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => getcwd() . '/module/Base/view/layout/layout.phtml',
            'application/index/index' => getcwd() . '/module/Base/view/application/index/index.phtml',
            'error/404'               => getcwd() . '/module/Base/view/error/404.phtml',
            'error/index'             => getcwd() . '/module/Base/view/error/index.phtml',
        ),
        'template_path_stack' => array(
            getcwd() . '/module/Base/view'
        ),
    )
);
