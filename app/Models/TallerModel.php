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

}