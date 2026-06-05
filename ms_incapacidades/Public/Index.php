<?php
use Slim\Factory\AppFactory;
use App\incapacidad\Modelos\incapacidad;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../App/Confi/ConDB.php';

$cors = require __DIR__ . '/../Middlewars/CorsMiddlewar.php';

$incapacidadesEndpoints   = require __DIR__ . '/../App/incapacidades/Presentacion/Routers/Endpoints.php';

$app = AppFactory::create();

$cors($app);

$incapacidadesEndpoints($app);

$app->run();