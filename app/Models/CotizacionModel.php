<?php

namespace App\Models;

use CodeIgniter\Model;

class CotizacionModel extends Model
{
	/**
     * ---
     * Insert
     * ---
     * Inserta a los datos de una Cotizacion del cliente
     * 
     * @param string $descripcion
     * @param dateTime $fechaCita
     * @param int $estado
     * @param int $idTaller
     * @param int $idCliente
     * @param int $idServicio
     */
    public function InsertCotizacion($descripcionProblema, $estado, $idTaller, $idCliente, $idServicio)
    {
        $builder = $this->db->table('cotizacion');
        $data = [
            'descripcionProblema' => $descripcionProblema,
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
     * Retorna todas las cotizaciones de un taller
     * 
     * 
     */
    public function SelectCotizacionTaller($idTaller)
    {
        $builder = $this->db->table('cotizacion C');
        $builder->select("C.descripcionProblema AS 'descripcionProblema', C.estado AS 'estado', S.descripcion AS 'servicio', CONCAT(CL.nombres,' ', CL.primerApellido, ' ', CL.segundoApellido) AS 'cliente', C.idCotizacion AS 'idCotizacion'");
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
     * Retorna todas las cotizaciones pendientes de un taller
     * 
     * 
     */
    public function SelectCotizacionTallerPendiente($idTaller)
    {
        $builder = $this->db->table('cotizacion C');
        $builder->select("C.descripcionProblema AS 'descripcionProblema', C.estado AS 'estado', S.descripcion AS 'servicio', CONCAT(CL.nombres,' ', CL.primerApellido, ' ', CL.segundoApellido) AS 'cliente', C.idCotizacion AS 'idCotizacion', C.idCliente AS 'idCliente'");
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
     * Update cambia los datos de una cotizacion realizada
     * 
     * @param int $idCotizacion
     * @param string $descripcionSolucion
     * @param string $costo
     * @param string $tiempoAprox
     * @param int $estado
     * @param date $fechaActualizacion
     */
    public function UpdateCotizacionRealizada($idCotizacion, $descripcionSolucion, $costo, $tiempoAprox, $estado, $fechaActualizacion)
    {
        $builder = $this->db->table('cotizacion');
        $builder->set('descripcionSolucion', $descripcionSolucion);
        $builder->set('costo', $costo);
        $builder->set('tiempoAprox', $tiempoAprox);
        $builder->set('estado', $estado);
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idCotizacion', $idCotizacion);
        return $builder->update();
    }
    /**
     * ---
     * Select
     * ---
     * Retorna todas las cotizaciones de un cliente
     * 
     * 
     */
    public function SelectCotizacionCliente($idCliente)
    {
        $builder = $this->db->table('cotizacion C');
        $builder->select("C.estado AS 'estado', S.descripcion AS 'servicio', C.idCotizacion AS 'idCotizacion', T.nombre AS 'nombre', C.tiempoAprox AS 'tiempoAproximado', C.costo AS 'costo'");
        $builder->join("servicio S","S.idServicio = C.idServicio", "inner");
        $builder->join("taller T", "T.idTaller = C.idTaller", "inner");
        $builder->where('C.idCliente',$idCliente);
        $query = $builder->get();
        return $query->getResult();
    }
    
}