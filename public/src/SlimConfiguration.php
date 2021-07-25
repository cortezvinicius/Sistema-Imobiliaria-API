<?php

namespace src;


function SlimConfiguration()
{
    $configuration = [
        'settings' => [
            'displayErrorDetails' => true,
            'determineRouteBeforeAppMiddleware' => true
        ],
    ];
    return new \Slim\Container($configuration);
}