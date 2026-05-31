<?php
namespace App\seguimiento\Controladores;

use App\seguimiento\Modelo\Seguimiento;
use Exception;

class seguimientoControlador {

    public function getseguimientos() {
        $rows = Seguimiento::all();
        return $rows->toJson();
    }

    public function guardarseguimiento($data) {
        try {
            $seguimiento = new Seguimiento();
            $seguimiento->incapacidad_id = $data['incapacidad_id'];
            $seguimiento->fecha = $data['fecha'];
            $seguimiento->comentario = $data['comentario'];
            $seguimiento->estado = $data['estado'];
            $seguimiento->usuario_responsable = $data['usuario_responsable'];
            $seguimiento->created_at = $data['created_at'] ?? now();
            $seguimiento->updated_at = $data['updated_at'] ?? now();
            $seguimiento->save();
            return $seguimiento->toJson();
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function mostrarseguimiento($id) {
        $seguimiento = Seguimiento::find($id);
        return $seguimiento ? $seguimiento->toJson() : json_encode(['error' => 'No encontrado']);
    }

    public function modificarseguimiento($id, $data) {
        $seguimiento = Seguimiento::find($id);
        if (!$seguimiento) return json_encode(['error' => 'No encontrado']);
        $seguimiento->fill($data);
        $seguimiento->save();
        return $seguimiento->toJson();
    }

    public function eliminarseguimiento($id) {
        $seguimiento = Seguimiento::find($id);
        if (!$seguimiento) return json_encode(['error' => 'No encontrado']);
        $seguimiento->delete();
        return json_encode(['success' => 'Seguimiento eliminado']);
    }

    public function obtenerporincapacidad($incapacidad_id)
{
    try {
        $seguimientos = Seguimiento::where('incapacidad_id', $incapacidad_id)->get();
        return $seguimientos->toJson();
    } catch (Exception $e) {
        return json_encode(['error' => $e->getMessage()]);
    }
}

}
