<?php

namespace App\Models;

use CodeIgniter\Model;

class AyudaModel extends Model
{
	/**
     * ---
     * Insert
     * ---
     * Inserta a los datos de una Ayuda del cliente
     * 
     * @param string $descripcion
     * @param dateTime $fechaCita
     * @param string $longitud
     * @param string $latitud
     * @param int $idTaller
     * @param int $idCliente
     */
    public function InsertAyuda($descripcionProblema, $descripcionAuto,$latitud,$longitud, $idTaller, $idCliente)
    {
        $builder = $this->db->table('ayuda');
        $data = [
            'descripcionProblema' => $descripcionProblema,
            'descripcionAutomovil' => $descripcionAuto,
            'latitud' => $latitud,
            'longitud' => $longitud,
            'idTaller' => $idTaller,
            'idCliente' => $idCliente
        ];
        $query = $builder->insert($data);
        return $query;
    }
    /**
     * ---
     * Select
     * ---
     * Retorna todas las ayudas solicitadas de un taller
     * 
     * 
     */
    public function SelectAyudaTaller($idTaller)
    {
        $builder = $this->db->table('ayuda A');
        $builder->select("A.descripcionProblema AS 'problema', A.descripcionAutomovil AS 'descripcionAutomovil', A.latitud AS 'latitudCliente', A.longitud AS 'longitudCliente', CONCAT(CL.nombres, ' ', CL.primerApellido, ' ',CL.segundoApellido) AS 'nombreCliente',T.latitud AS 'latitudTaller', T.longitud AS 'longitudTaller', A.idAyuda AS 'idAyuda', A.estado AS 'estado', CL.celular AS 'celular'");
        $builder->join("cliente CL","CL.idCliente = A.idCliente", "inner");
        $builder->join("taller T", "T.idTaller = A.idTaller", "inner");
        $builder->where('A.idTaller',$idTaller);
        $builder->where('A.estado > 0');
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Update
     * ---
     * Update cambia los datos de la ayuda
     * 
     * @param int $idAyuda
     * @param int $estado
     * @param date $fechaActualizacion
     */
    public function UpdateAyudaEstado($idAyuda, $estado, $fechaActualizacion)
    {
        $builder = $this->db->table('ayuda');
        $builder->set('estado', $estado);
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idAyuda', $idAyuda);
        return $builder->update();
    }
    
}