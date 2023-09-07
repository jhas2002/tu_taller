<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicioModel extends Model
{
	/**
     * ---
     * Select
     * ---
     * Selecciona todos los servicios 
     */

    public function SelectServicio()
    {
        $builder = $this->db->table('servicio');
        $builder->select("descripcion");
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Select
     * ---
     * Retorna el id de un servicio
     * 
     * @param String $descripcion
     */
    public function SelecIdServicio($descripcion)
    {
        $builder = $this->db->table('servicio');
        $builder->select("*");
        $builder->where('descripcion',$descripcion);
        $query = $builder->get();
        $res = 0;
        foreach ($query->getResult() as $row) {
            $res = $row->idServicio;
        }
        return $res;
    }
}