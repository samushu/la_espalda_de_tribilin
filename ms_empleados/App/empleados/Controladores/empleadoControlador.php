<?php
// Controladooooor de logica de empleados
namespace App\empleados\Controladores;

use App\empleados\Modelo\Empleado;
use Exception;

class empleadoControlador {

    public function getempleados() {
        $rows = Empleado::all();
        return $rows->toJson();
    }

    public function guardarempleado($data) {
        try {
            $empleado = new Empleado();
            $empleado->nombres = $data['nombres'];
            $empleado->apellidos = $data['apellidos'];
            $empleado->documento = $data['documento'];
            $empleado->correo = $data['correo'];
            $empleado->telefono = $data['telefono'];
            $empleado->cargo = $data['cargo'];
            $empleado->area = $data['area'];
            $empleado->fecha_ingreso = $data['fecha_ingreso'];
            $empleado->estado = $data['estado'] ?? 'activo';
            $empleado->created_at = $data['created_at'] ?? date('Y-m-d H:i:s');
            $empleado->updated_at = $data['updated_at'] ?? date('Y-m-d H:i:s');
            $empleado->save();
            return $empleado->toJson();
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function mostrarempleado($id) {
        $empleado = Empleado::find($id);
        return $empleado ? $empleado->toJson() : json_encode(['error' => 'No encontrado']);
    }

    public function modificarempleado($id, $data) {
        $empleado = Empleado::find($id);
        if (!$empleado) return json_encode(['error' => 'No encontrado']);
        $empleado->fill($data);
        $empleado->save();
        return $empleado->toJson();
    }

    public function eliminarempleado($id) {
        $empleado = Empleado::find($id);
        if (!$empleado) return json_encode(['error' => 'No encontrado']);
        $empleado->delete();
        return json_encode(['success' => 'Empleado eliminado']);
    }
}
