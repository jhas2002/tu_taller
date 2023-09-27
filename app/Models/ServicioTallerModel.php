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
    /**
     * ---
     * Select
     * ---
     * Retorna todos los nombres de los servicios de un taller
     * 
     * 
     */
    public function SelectServiciosTaller($idTaller)
    {
        $builder = $this->db->table('serviciotaller ST');
        $builder->select("S.descripcion AS 'descripcion', ST.estado AS 'estado', ST.idServicio AS 'idServicio'");
        $builder->join("servicio S", "S.idServicio = ST.idServicio", "inner");
        $builder->where('ST.idTaller',$idTaller);
        $builder->orderBy("ST.estado", "desc");
        $query = $builder->get();
        return $query->getResult();
    }

    /**
     * ---
     * Select
     * ---
     * Retorna un email si existe
     */
    public function ServicioExists($idServicio, $idUsuario)
    {
        $builder = $this->db->table('serviciotaller');
        $builder->select("idServicio");
        $builder->where("idServicio", $idServicio);
        $builder->where("idTaller", $idUsuario);
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Update
     * ---
     * Update cambia el estado de un servicio de un taller
     * 
     * @param int $idTaler
     * @param int $idServicio
     * @param date $fechaActualizacion
     */
    public function UpdateServicioTaller($idTaller, $idServicio, $fechaActualizacion, $estado)
    {
        $builder = $this->db->table('serviciotaller');
        $builder->set('estado', $estado);
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idTaller', $idTaller);
        $builder->where('idServicio', $idServicio);
        return $builder->update();
    }
}