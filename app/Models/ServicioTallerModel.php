<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicioTallerModel extends Model
{
	/**
     * ---
     * Insert
     * ---
     * Inserta a los datos de un Servicio a un taller
     * 
     * @param int $idServicio
     * @param int $idTaller
     */
    public function InsertServicioTaller($idServicio, $idTaller)
    {
        $builder = $this->db->table('serviciotaller');
        $data = [
            'idServicio' => $idServicio,
            'idTaller' => $idTaller
        ];
        $query = $builder->insert($data);
        return $query;
    }
}