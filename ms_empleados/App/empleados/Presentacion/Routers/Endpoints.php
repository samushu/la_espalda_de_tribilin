<?php

use Slim\App;
use App\empleados\Presentacion\Repositorio\empleadoRepositorio;

return function (App $app) {
    $app->get('/empleados', [empleadoRepositorio::class, 'allempleado']);
    $app->post('/empleado', [empleadoRepositorio::class, 'createempleado']);
    $app->get('/empleado/{id}', [empleadoRepositorio::class, 'detailempleado']);
    $app->put('/empleado/{id}', [empleadoRepositorio::class, 'updateempleado']);
    $app->delete('/empleado/{id}', [empleadoRepositorio::class, 'deleteempleado']);
};
