# la_espalda_de_tribilin



Configuración inicial
1. Clona el repositorio:

git clone https://github.com/samushu/la_espalda_de_tribilin.git

cd C:\Users\samia\Documents\la_espalda_de_tribilin

2. Instala las dependencias en cada microservicio: (revisar si php esta mas de version 8,2)


2.1 cd ms_auth
composer install

2.2 cd ../ms_empleados
composer install

2.3 cd ../ms_incapacidades
composer install

2.4 cd ../ms_seguimiento
composer install

sino esta actualizada instalar php 8,3+
clonar el php.ini antiguo
reenombrar el archivo php x86 a php y reemplzarlo en xampp
copiar el php.ini antiguo para no afectar dependencias

3. Asegúrate de tener MySQL activo en XAMPP y las bases de datos creadas:

-ms_auth

-ms_empleados

-ms_incapacidad

-ms_seguimiento

4. Configura la conexión de Eloquent en cada index.php:

php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'nombre_de_la_base',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

5. Cada microservicio se ejecuta en su propio puerto.
Abre una terminal por cada uno y corre los siguientes comandos:

5.1 # Autenticación
php -S 127.0.0.1:8000 -t ms_auth/Public ms_auth/Public/index.php

5.2 # Empleados
php -S 127.0.0.1:8001 -t ms_empleados/Public ms_empleados/Public/index.php

5.3 # Incapacidad
php -S 127.0.0.1:8002 -t ms_incapacidades/Public ms_incapacidades/Public/index.php

5.4 # Seguimiento
php -S 127.0.0.1:8003 -t ms_seguimiento/Public ms_seguimiento/Public/index.php

Pruebas con REST Client
En la carpeta docs_api/ encontrarás los archivos .http para probar cada microservicio:

Código
docs_api/
├── auth.http
├── empleados.http
├── incapacidad.http
└── seguimiento.http
Abre cualquiera en VS Code y ejecuta las peticiones con la extensión REST Client.

Estructura del proyecto
Código
la_espalda_de_tribilin/
├── ms_auth/
│   ├── App/
│   ├── Public/
│   ├── Presentacion/
│   └── vendor/
├── ms_empleados/
├── ms_incapacidad/
├── ms_seguimiento/
└── docs_api/