<?php
namespace App\incapacidad\Presentacion\Repositorios;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\incapacidad\Controladores\incapacidadControlador;
use Exception;

class incapacidadRepositorio
{
    function allincapacidad(Request $request, Response $response)
    {
        $controller = new incapacidadControlador();
        $incapacidades = $controller->getincapacidades();
        $response->getBody()->write($incapacidades);
        return $response->withHeader("Content-Type", "application/json");
    }

    function createincapacidad(Request $request, Response $response)
    {
        $data = json_decode($request->getBody()->getContents(), true);
        $controller = new incapacidadControlador();
        $incapacidad = $controller->guardarincapacidad($data);
        $response->getBody()->write($incapacidad);
        return $response->withStatus(201)->withHeader("Content-Type", "application/json");
    }

    function detailincapacidad(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $controller = new incapacidadControlador();
            $incapacidad = $controller->mostrarincapacidad($id);
            $resp->getBody()->write($incapacidad);
            return $resp->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function updateincapacidad(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $data = json_decode($req->getBody()->getContents(), true);
            $controller = new incapacidadControlador();
            $incapacidad = $controller->modificarincapacidad($id, $data);
            $resp->getBody()->write($incapacidad);
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function deleteincapacidad(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $controller = new incapacidadControlador();
            $controller->eliminarincapacidad($id);
            $resp->getBody()->write(json_encode(['msg' => 'Incapacidad eliminada']));
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function filterincapacidad(Request $req, Response $resp)
    {
        try {
            $params = $req->getQueryParams();
            $controller = new incapacidadControlador();
            $incapacidades = $controller->filtrarincapacidades($params);
            $resp->getBody()->write($incapacidades);
            return $resp->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }
}
