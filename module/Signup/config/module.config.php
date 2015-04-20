<?php
/**
 * Created by PhpStorm.
 * User: gmeyenberg
 * Date: 13.04.2015
 * Time: 17:24
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'Signup\Controller\Signup' => 'Signup\Controller\SignupController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'signup' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Signup\Controller\Signup',
                        'action' => 'signup',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),
);