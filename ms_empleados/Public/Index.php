<?php
use Slim\Factory\AppFactory;
use App\empleados\Modelos\empleado;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../App/Confi/ConDB.php';

$cors = require __DIR__ . '/../Middlewars/CorsMiddlewar.php';

$empleadosEndpoints   = require __DIR__ . '/../App/empleados/Presentacion/Routers/Endpoints.php';

$app = AppFactory::create();

$cors($app);

$empleadosEndpoints($app);

$app->run();