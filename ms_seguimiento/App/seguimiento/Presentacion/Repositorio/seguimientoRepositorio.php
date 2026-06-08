<?php
namespace App\seguimiento\Presentacion\Repositorio;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\seguimiento\Controladores\seguimientoControlador;
use Exception;

class seguimientoRepositorio
{
    function allseguimiento(Request $request, Response $response)
    {
        $controller = new seguimientoControlador();
        $seguimientos = $controller->getseguimientos();
        $response->getBody()->write($seguimientos);
        return $response->withHeader("Content-Type", "application/json");
    }

    function createseguimiento(Request $request, Response $response)
    {
        $data = json_decode($request->getBody()->getContents(), true);
        $controller = new seguimientoControlador();
        $seguimiento = $controller->guardarseguimiento($data);
        $response->getBody()->write($seguimiento);
        return $response->withStatus(201)->withHeader("Content-Type", "application/json");
    }

    function detailseguimiento(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $controller = new seguimientoControlador();
            $seguimiento = $controller->mostrarseguimiento($id);
            $resp->getBody()->write($seguimiento);
            return $resp->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function updateseguimiento(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $data = json_decode($req->getBody()->getContents(), true);
            $controller = new seguimientoControlador();
            $seguimiento = $controller->modificarseguimiento($id, $data);
            $resp->getBody()->write($seguimiento);
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function deleteseguimiento(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $controller = new seguimientoControlador();
            $controller->eliminarseguimiento($id);
            $resp->getBody()->write(json_encode(['msg' => 'Seguimiento eliminado']));
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function byincapacidad(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['incapacidad_id'];
            $controller = new seguimientoControlador();
            $seguimientos = $controller->obtenerporincapacidad($id);
            $resp->getBody()->write($seguimientos);
            return $resp->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }
}
