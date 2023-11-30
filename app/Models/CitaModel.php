<?php

namespace App\Models;

use CodeIgniter\Model;

class CitaModel extends Model
{
	/**
     * ---
     * Insert
     * ---
     * Inserta a los datos de una cita
     * 
     * @param string $descripcion
     * @param dateTime $fechaCita
     * @param int $estado
     * @param int $idTaller
     * @param int $idCliente
     * @param int $idServicio
     */
    public function InsertCita($descripcion, $fechaCita, $estado, $idTaller, $idCliente, $idServicio)
    {
        $builder = $this->db->table('cita');
        $data = [
            'descripcion' => $descripcion,
            'fechaCita' => $fechaCita,
            'estado' => $estado,
            'idTaller' => $idTaller,
            'idCliente' => $idCliente,
            'idServicio' => $idServicio
        ];
        $query = $builder->insert($data);
        return $query;
    }
    /**
     * ---
     * Select
     * ---
     * Retorna todas las citas de un taller
     * 
     * 
     */
    public function SelectCitasTaller($idTaller)
    {
        $builder = $this->db->table('cita C');
        $builder->select("C.descripcion AS 'descripcionProblema', C.fechaCita AS 'fechaCita', C.estado AS 'estado', S.descripcion AS 'servicio', CONCAT(CL.nombres,' ', CL.primerApellido, ' ', CL.segundoApellido) AS 'cliente', C.idCita AS 'idCita'");
        $builder->join("servicio S","S.idServicio = C.idServicio", "inner");
        $builder->join("cliente CL", "CL.idCliente = C.idCliente", "inner");
        $builder->where('C.idTaller',$idTaller);
        $builder->where('C.estado > 0');
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Select
     * ---
     * Retorna todas las citas de un taller
     * 
     * 
     */
    public function SelectCitasTallerPendiente($idTaller)
    {
        $builder = $this->db->table('cita C');
        $builder->select("C.descripcion AS 'descripcionProblema', C.fechaCita AS 'fechaCita', C.estado AS 'estado', S.descripcion AS 'servicio', CONCAT(CL.nombres,' ', CL.primerApellido, ' ', CL.segundoApellido) AS 'cliente', C.idCita AS 'idCita', C.idCliente AS 'idCliente'");
        $builder->join("servicio S","S.idServicio = C.idServicio", "inner");
        $builder->join("cliente CL", "CL.idCliente = C.idCliente", "inner");
        $builder->where('C.idTaller',$idTaller);
        $builder->where('C.estado', '0');
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Update
     * ---
     * Update cambia la fecha de la cita y el estado
     * 
     * @param int $idCita
     * @param date $fechaCita
     * @param int $estado
     * @param date $fechaActualizacion
     */
    public function UpdateCitaEstadoFecha($idCita, $fechaCita, $estado, $fechaActualizacion)
    {
        $builder = $this->db->table('cita');
        $builder->set('fechaCita', $fechaCita);
        $builder->set('estado', $estado);
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idCita', $idCita);
        return $builder->update();
    }
    /**
     * ---
     * Update
     * ---
     * Update cambia el estado
     * 
     * @param int $idCita
     * @param int $estado
     * @param date $fechaActualizacion
     */
    public function UpdateCitaEstado($idCita, $estado, $fechaActualizacion)
    {
        $builder = $this->db->table('cita');
        $builder->set('estado', $estado);
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idCita', $idCita);
        return $builder->update();
    }
}