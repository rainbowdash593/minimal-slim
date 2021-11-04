<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Container\ContainerInterface;

class HelloController
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->logger = $container->get('logger');
    }

    public function hello(Request $request, Response $response, $args) {
        $this->logger->addInfo('ajasdasd');
        $this->logger->addInfo(getenv('S3_BUCKET'));
        return $response->write("Hello " . $args['name']);
    }

}