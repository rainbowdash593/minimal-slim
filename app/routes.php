<?php
use Slim\App;
use App\Controllers\HelloController;

return function (App $app) {
    $app->group('/api', function ($group) {
        $group->get('/hello/{name}', HelloController::class . ':hello');
    });
};