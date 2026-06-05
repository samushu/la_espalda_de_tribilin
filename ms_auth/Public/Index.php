<?php
use Slim\Factory\AppFactory;
use App\auth\Modelos\auth;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../App/Confi/ConDB.php';

$cors = require __DIR__ . '/../Middlewars/CorsMiddlewar.php';

$AuthEndpoints   = require __DIR__ . '/../App/auth/Presentacion/Routers/Endpoints.php';

$app = AppFactory::create();

$cors($app);

$AuthEndpoints($app);

$app->run();