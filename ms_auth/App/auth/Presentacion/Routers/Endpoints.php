<?php

use Slim\App;
use App\auth\Presentacion\Repositorios\authRepositorio;

return function (App $app) {
    $app->get('/usuarios', [authRepositorio::class, 'allusuario']);
    $app->post('/usuario', [authRepositorio::class, 'createusuario']);
    $app->get('/usuario/{id}', [authRepositorio::class, 'detailusuario']);
    $app->put('/usuario/{id}', [authRepositorio::class, 'updateusuario']);
    $app->delete('/usuario/{id}', [authRepositorio::class, 'deleteusuario']);
    $app->post('/login', [authRepositorio::class, 'loginusuario']);
    $app->post('/logout', [authRepositorio::class, 'logoutusuario']);
    $app->post('/validar-token', [authRepositorio::class, 'validartoken']);
};
