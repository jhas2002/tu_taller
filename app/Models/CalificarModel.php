<?php

namespace App\Models;

use CodeIgniter\Model;

class CAlificarModel extends Model
{
	

    /**
     * ---
     * Select
     * ---
     * Retorna un numero si existe
     */
    public function CalificacionExist($idTaller, $idCliente)
    {
        $builder = $this->db->table('calificacion');
        $builder->select("calificacion");
        $builder->where("idTaller", $idTaller);
        $builder->where("idCliente", $idCliente);
        $query = $builder->get();
        return $query->getResult();
    }

    /**
     * ---
     * Insert
     * ---
     * Inserta a los datos de una cita
     * @param int $idTaller
     * @param int $idCliente
     * @param int $calificacion
     */
    public function InsertCalificacion($idTaller, $idCliente, $calificacion)
    {
        $builder = $this->db->table('calificacion');
        $data = [
            'idTaller' => $idTaller,
            'idCliente' => $idCliente,
            'calificacion' => $calificacion
        ];
        $query = $builder->insert($data);
        return $query;
    }
    /**
     * ---
     * Update
     * ---
     * Update cambia el valor de una calificacion 
     * 
     * @param int $idTaller
     * @param int $idCliente
     * @param int calificacion
     * @param date $fechaActualizacion
     */
    public function UpdateCalificacion($idTaller, $idCliente, $calificacion, $fechaActualizacion)
    {
        $builder = $this->db->table('calificacion');
        $builder->set('calificacion', $calificacion);
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idTaller', $idTaller);
        $builder->where('idCliente', $idCliente);
        return $builder->update();
    }
}