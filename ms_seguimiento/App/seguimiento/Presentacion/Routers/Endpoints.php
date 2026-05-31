<?php

use Slim\App;
use App\seguimiento\Presentacion\Repositorios\seguimientoRepositorio;

return function (App $app) {
    $app->get('/seguimientos', [seguimientoRepositorio::class, 'allseguimiento']);
    $app->post('/seguimiento', [seguimientoRepositorio::class, 'createseguimiento']);
    $app->get('/seguimiento/{id}', [seguimientoRepositorio::class, 'detailseguimiento']);
    $app->put('/seguimiento/{id}', [seguimientoRepositorio::class, 'updateseguimiento']);
    $app->delete('/seguimiento/{id}', [seguimientoRepositorio::class, 'deleteseguimiento']);
    $app->get('/seguimientos/incapacidad/{incapacidad_id}', [seguimientoRepositorio::class, 'byincapacidad']);
};
