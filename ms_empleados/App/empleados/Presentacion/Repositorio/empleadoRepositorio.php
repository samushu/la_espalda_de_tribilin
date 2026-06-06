<?php
namespace App\empleados\Presentacion\Repositorio;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\empleados\Controladores\empleadoControlador;
use Exception;

class empleadoRepositorio
{
    function allempleado(Request $request, Response $response)
    {
        $controller = new empleadoControlador();
        $empleados = $controller->getempleados();
        $response->getBody()->write($empleados);
        return $response->withHeader("Content-Type", "application/json");
    }

    function createempleado(Request $request, Response $response)
    {
        $data = json_decode($request->getBody()->getContents(), true);
        $controller = new empleadoControlador();
        $empleado = $controller->guardarempleado($data);
        $response->getBody()->write($empleado);
        return $response->withStatus(201)->withHeader("Content-Type", "application/json");
    }

    function detailempleado(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $controller = new empleadoControlador();
            $empleado = $controller->mostrarempleado($id);
            $resp->getBody()->write($empleado);
            return $resp->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function updateempleado(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $data = json_decode($req->getBody()->getContents(), true);
            $controller = new empleadoControlador();
            $empleado = $controller->modificarempleado($id, $data);
            $resp->getBody()->write($empleado);
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function deleteempleado(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $controller = new empleadoControlador();
            $controller->eliminarempleado($id);
            $resp->getBody()->write(json_encode(['msg' => 'Empleado eliminado']));
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }
}
