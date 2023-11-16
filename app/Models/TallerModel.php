<?php

namespace App\Models;

use CodeIgniter\Model;

class TallerModel extends Model
{
	/**
     * ---
     * Select
     * ---
     * Selecciona todos los dias 
     */

    public function SelectDia()
    {
        $builder = $this->db->table('dia');
        $builder->select("nombreDia");
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Insert
     * ---
     * Inserta a los datos de un taller
     * 
     * @param int $id
     * @param string $nombre
     * @param string $telefono
     * @param string $descripcion
     * @param string $direccion
     * @param string $latitud
     * @param string $longitud
     * @param int $foto
     */
    public function InsertTaller($idUsuario, $nombre,$telefono, $descripcion,$direccion,$latitud,$longitud,$foto)
    {
        $builder = $this->db->table('taller');
        $data = [
            'idTaller' => $idUsuario,
            'nombre' => $nombre,
            'telefono' => $telefono,
            'descripcion' => $descripcion,
            'direccion' => $direccion,
            'latitud' => $latitud,
            'longitud' => $longitud,
            'fotoPerfil' => $foto
        ];
        $query = $builder->insert($data);
        return $query;
    }

    /**
     * ---
     * Select
     * ---
     * Retorna el id de un dia
     * 
     * @param String $nombreDia
     */
    public function SelecIdDia($nombreDia)
    {
        $builder = $this->db->table('dia');
        $builder->select("*");
        $builder->where('nombreDia',$nombreDia);
        $query = $builder->get();
        $res = 0;
        foreach ($query->getResult() as $row) {
            $res = $row->idDia;
        }
        return $res;
    }
    /**
     * ---
     * Select
     * ---
     * Retorna el numero de un taller
     * 
     * @param String $nombreDia
     */
    public function SelecNumeroTaller($idTaller)
    {
        $builder = $this->db->table('taller');
        $builder->select("*");
        $builder->where('idTaller',$idTaller);
        $query = $builder->get();
        $res = 0;
        foreach ($query->getResult() as $row) {
            $res = $row->telefono;
        }
        return $res;
    }
    /**
     * ---
     * Insert
     * ---
     * Inserta a los datos de un Servicio a un taller
     * 
     * @param int $idServicio
     * @param int $idTaller
     * @param string $horaInicio
     * @param string $horaFin
     */
    public function InsertHorario($idTaller, $idDia, $horaInicio, $horaFinal)
    {
        $builder = $this->db->table('horario');
        $data = [
            'idTaller' => $idTaller,
            'idDia' => $idDia,
            'horaInicio' => $horaInicio,
            'horaFin' => $horaFinal
        ];
        $query = $builder->insert($data);
        return $query;
    }
    /**
     * ---
     * Select
     * ---
     * Retorna los datos del taller
     * 
     * @param int $id
     */
    public function SelectById($id)
    {
        $builder = $this->db->table('taller');
        $builder->select("*");
        $builder->where('idTaller', $id);
        $query = $builder->get();
        return $query;
    }
    /**
     * ---
     * Select
     * ---
     * Retorna los datos del taller para el pdf
     * 
     * @param int $id
     */
    public function SelectByIdPDF($idTaller)
    {
        $builder = $this->db->table('taller T');
        $builder->select("T.nombre AS 'nombreTaller', T.direccion AS 'direccion', T.telefono AS 'telefono', U.email AS 'email'");
        $builder->join("usuario U", "U.idUsuario = T.idTaller", "inner");
        $builder->where('idTaller', $idTaller);
        $query = $builder->get();
        return $query;
    }
    /**
     * ---
     * Select
     * ---
     * Retorna el horario del taller
     * 
     * @param int $id
     */
    public function SelecHorarioTaller($id)
    {
        $builder = $this->db->table('horario H');
        $builder->select("D.nombreDia AS 'dia', H.horaInicio AS 'HoraInicio', H.horaFin AS 'HoraFin'");
        $builder->join("dia D", "H.idDia = D.idDia", "inner");
        $builder->where('idTaller', $id);
        $builder->where('estado', 1);
        $query = $builder->get();
        return $query;
    }
    /**
     * ---
     * Update
     * ---
     * Update cambia el valor de la foto del usuario
     * 
     * @param int $idUsuario
     * @param date $fechaActualizacion
     */
    public function UpdateTallerFoto($idUsuario,$fechaActualizacion)
    {
        $builder = $this->db->table('taller');
        $builder->set('fotoPerfil', '1');
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idTaller', $idUsuario);
        return $builder->update();
    }

    /**
     * ---
     * Update
     * ---
     * Update cambia los datos de un taller
     * 
     * @param int $idUsuario
     * @param string $nombre
     * @param string $telefono
     * @param string $direccon
     * @param string $descripcion
     * @param date $fechaActualizacion
     */
    public function UpdateTaller($idUsuario, $nombre, $telefono, $direccion, $descripcion,$fechaActualizacion)
    {
        $builder = $this->db->table('taller');
        $builder->set('nombre', $nombre);
        $builder->set('telefono', $telefono);
        $builder->set('direccion', $direccion);
        $builder->set('descripcion', $descripcion);
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idTaller', $idUsuario);
        return $builder->update();
    }

    /**
     * ---
     * Update
     * ---
     * Update cambia el valor del estado de un dia del horario inabilitandolo 
     * 
     * @param int $idUsuario
     * @param int $idDia
     * @param date $fechaActualizacion
     */
    public function DeleteHorario($idUsuario,$idDia,$fechaActualizacion)
    {
        $builder = $this->db->table('horario');
        $builder->set('estado', '0');
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idTaller', $idUsuario);
        $builder->where('idDia', $idDia);
        return $builder->update();
    }

    /**
     * ---
     * Update
     * ---
     * Update cambia la hora de inicio y fin de un horario 
     * 
     * @param int $idUsuario
     * @param int $idDia
     * @param string $horaInicio
     * @param string $horaFin
     * @param date $fechaActualizacion
     */
    public function UpdateHorario($idUsuario, $idDia, $horaInicio, $horaFin, $fechaActualizacion)
    {
        $builder = $this->db->table('horario');
        $builder->set('horaInicio', $horaInicio);
        $builder->set('horaFin', $horaFin);
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idTaller', $idUsuario);
        $builder->where('idDia', $idDia);
        return $builder->update();
    }
    /**
     * ---
     * Select
     * ---
     * Retorna todos los datos de un taller
     * 
     * 
     */
    public function SelectTalleres()
    {
        $builder = $this->db->table('Taller T');
        $builder->select("T.nombre AS 'nombre', T.fotoPerfil AS 'fotoPerfil', T.idTaller AS 'idTaller', AVG(C.calificacion) AS 'calificacion'");
        $builder->join("calificacion C", "C.idTaller = T.idTaller", "left");
        $builder->groupBy("T.idTaller");
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Select
     * ---
     * Retorna todos los datos de los talleres
     * 
     * 
     */
    public function SelectTalleresAyuda()
    {
        $builder = $this->db->table('taller T');
        $builder->select("T.nombre AS 'nombre', T.idTaller AS 'idTaller', T.latitud AS 'latitud', T.longitud AS 'longitud',T.fotoPerfil AS 'fotoPerfil', AVG(C.calificacion) AS 'calificacion'");
        $builder->join("calificacion C", "C.idTaller = T.idTaller", "left");
        $builder->groupBy("T.idTaller");
        $query = $builder->get();
        return $query->getResult();
    }

}