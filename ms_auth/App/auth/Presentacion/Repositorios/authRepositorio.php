<?php
namespace App\auth\Presentacion\Repositorios;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\auth\Controladores\authControlador;
use Exception;

class authRepositorio
{
    function allusuario(Request $request, Response $response)
    {
        $controller = new authControlador();
        $usuarios = $controller->getusuarios();
        $response->getBody()->write($usuarios);
        return $response->withHeader("Content-Type", "application/json");
    }

    function createusuario(Request $request, Response $response)
    {
        $data = json_decode($request->getBody()->getContents(), true);
        $controller = new authControlador();
        $usuario = $controller->guardarusuario($data);
        $response->getBody()->write($usuario);
        return $response->withStatus(201)->withHeader("Content-Type", "application/json");
    }

    function detailusuario(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $controller = new authControlador();
            $usuario = $controller->mostrarusuario($id);
            $resp->getBody()->write($usuario);
            return $resp->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function updateusuario(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $data = json_decode($req->getBody()->getContents(), true);
            $controller = new authControlador();
            $usuario = $controller->modificarusuario($id, $data);
            $resp->getBody()->write($usuario);
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function deleteusuario(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $controller = new authControlador();
            $controller->eliminarusuario($id);
            $resp->getBody()->write(json_encode(['msg' => 'Usuario eliminado']));
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function loginusuario(Request $req, Response $resp)
    {
        try {
            $data = json_decode($req->getBody()->getContents(), true);
            $controller = new authControlador();
            $login = $controller->loginusuario($data);
            $resp->getBody()->write($login);
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }
    
    function logoutusuario(Request $req, Response $resp)
    {
        try {
            $data = json_decode($req->getBody()->getContents(), true);
            $controller = new authControlador();
            $logout = $controller->logoutusuario($data['token']);
            $resp->getBody()->write($logout);
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }

    function validartoken(Request $req, Response $resp)
    {
        try {
            $data = json_decode($req->getBody()->getContents(), true);
            $controller = new authControlador();
            $validacion = $controller->validartoken($data['token']);
            $resp->getBody()->write($validacion);
            return $resp->withStatus(200)->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            return $resp->withStatus(400);
        }
    }
}
