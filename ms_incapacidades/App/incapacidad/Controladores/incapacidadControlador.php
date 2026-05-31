<?php
namespace App\incapacidad\Controladores;

use App\incapacidad\Modelo\Incapacidad;
use Exception;

class incapacidadControlador {

    public function getincapacidades() {
        $rows = Incapacidad::all();
        return $rows->toJson();
    }

    public function guardarincapacidad($data) {
        try {
            $incapacidad = new Incapacidad();
            $incapacidad->empleado_id = $data['empleado_id'];
            $incapacidad->fecha_inicio = $data['fecha_inicio'];
            $incapacidad->fecha_fin = $data['fecha_fin'];
            $incapacidad->tipo = $data['tipo'];
            $incapacidad->diagnostico_general = $data['diagnostico_general'];
            $incapacidad->entidad_medica = $data['entidad_medica'];
            $incapacidad->observaciones = $data['observaciones'] ?? null;
            $incapacidad->dias_incapacidad = $data['dias_incapacidad'];
            $incapacidad->estado = $data['estado'] ?? 'registrada';
            $incapacidad->created_at = $data['created_at'] ?? now();
            $incapacidad->updated_at = $data['updated_at'] ?? now();
            $incapacidad->save();
            return $incapacidad->toJson();
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function mostrarincapacidad($id) {
        $incapacidad = Incapacidad::find($id);
        return $incapacidad ? $incapacidad->toJson() : json_encode(['error' => 'No encontrada']);
    }

    public function modificarincapacidad($id, $data) {
        $incapacidad = Incapacidad::find($id);
        if (!$incapacidad) return json_encode(['error' => 'No encontrada']);
        $incapacidad->fill($data);
        $incapacidad->save();
        return $incapacidad->toJson();
    }

    public function eliminarincapacidad($id) {
        $incapacidad = Incapacidad::find($id);
        if (!$incapacidad) return json_encode(['error' => 'No encontrada']);
        $incapacidad->delete();
        return json_encode(['success' => 'Incapacidad eliminada']);
    }

    public function filtrarincapacidades($params)   {
    try {
        $query = Incapacidad::query();
        if (isset($params['tipo'])) {
            $query->where('tipo', $params['tipo']);
        }
        if (isset($params['estado'])) {
            $query->where('estado', $params['estado']);
        }
        $resultados = $query->get();
        return $resultados->toJson();
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
}

}

