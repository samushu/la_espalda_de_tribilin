<?php

use Slim\App;
use App\incapacidad\Presentacion\Repositorios\incapacidadRepositorio;

return function (App $app) {
    $app->get('/incapacidades', [incapacidadRepositorio::class, 'allincapacidad']);
    $app->post('/incapacidad', [incapacidadRepositorio::class, 'createincapacidad']);
    $app->get('/incapacidad/{id}', [incapacidadRepositorio::class, 'detailincapacidad']);
    $app->put('/incapacidad/{id}', [incapacidadRepositorio::class, 'updateincapacidad']);
    $app->delete('/incapacidad/{id}', [incapacidadRepositorio::class, 'deleteincapacidad']);
    $app->get('/incapacidades/filtrar', [incapacidadRepositorio::class, 'filterincapacidad']);
};
