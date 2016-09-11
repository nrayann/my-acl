<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'MyAcl',
    ['path' => '/my-acl'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
