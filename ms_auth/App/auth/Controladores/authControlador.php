<?php
// Controladooooor para manejar la lógica de autenticación y gestión de usuarios
namespace App\auth\Controladores;

use App\auth\Modelo\Usuario;
use Exception;

class authControlador {

    public function getusuarios() {
        $rows = Usuario::all();
        return $rows->toJson();
    }

    public function guardarusuario($data) {
        try {
            $usuario = new Usuario();
            $usuario->nombre = $data['nombre'];
            $usuario->correo = $data['correo'];
            $usuario->usuario = $data['usuario'];
            $usuario->contrasena = $data['contrasena'];
            $usuario->rol = $data['rol'];
            $usuario->token = $data['token'] ?? null;
            $usuario->sesion_activa = $data['sesion_activa'] ?? false;
            $usuario->estado = $data['estado'] ?? 'activo';
            $usuario->created_at = $data['created_at'] ?? date('Y-m-d H:i:s');
            $usuario->updated_at = $data['updated_at'] ?? date('Y-m-d H:i:s');
            $usuario->save();
            return $usuario->toJson();
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function mostrarusuario($id) {
        $usuario = Usuario::find($id);
        return $usuario ? $usuario->toJson() : json_encode(['error' => 'No encontrado']);
    }

    public function modificarusuario($id, $data) {
        $usuario = Usuario::find($id);
        if (!$usuario) return json_encode(['error' => 'No encontrado']);
        $usuario->fill($data);
        $usuario->save();
        return $usuario->toJson();
    }

    public function eliminarusuario($id) {
        $usuario = Usuario::find($id);
        if (!$usuario) return json_encode(['error' => 'No encontrado']);
        $usuario->delete();
        return json_encode(['success' => 'Usuario eliminado']);
    }

    public function loginusuario($data) {
    try {
        $usuario = Usuario::where('usuario', $data['usuario'])->first();
        if (!$usuario) {
            return json_encode(['error' => 'Usuario no encontrado']);
        }
        if ($usuario->contrasena !== $data['contrasena']) {
            return json_encode(['error' => 'Contraseña incorrecta']);
        }

        $token = md5($usuario->usuario . time());
        $usuario->token = $token;
        $usuario->sesion_activa = true;
        $usuario->save();

        return json_encode([
            'msg' => 'Login exitoso',
            'token' => $token,
            'usuario' => $usuario->usuario,
            'rol' => $usuario->rol
        ]);
    } catch (Exception $e) {
        return json_encode(['error' => $e->getMessage()]);
    }
    }

    public function logoutusuario($token)
    {
        try {
            $usuario = Usuario::where('token', $token)->first();
            if (!$usuario) {
                return json_encode(['error' => 'Token inválido']);
            }
            $usuario->token = null;
            $usuario->sesion_activa = false;
            $usuario->save();
            return json_encode(['msg' => 'Sesión cerrada correctamente']);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function validartoken($token)
    {
        try {
            $usuario = Usuario::where('token', $token)->first();
            if (!$usuario) {
                return json_encode(['error' => 'Token inválido']);
            }
            if (!$usuario->sesion_activa) {
                return json_encode(['error' => 'Sesión no activa']);
            }
            return json_encode([
                'msg' => 'Token válido',
                'usuario' => $usuario->usuario,
                'rol' => $usuario->rol
            ]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}