<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
	

    /**
     * ---
     * Select
     * ---
     * Retorna todos los usuarios
     * 
     * 
     */
    public function SelectUsuarios()
    {
        $builder = $this->db->table('usuario U');
        $builder->select("U.idUsuario AS 'id', T.nombre AS 'taller', CONCAT(C.nombres,' ',C.primerApellido, ' ',C.segundoApellido) AS 'cliente', U.rol AS 'rol', C.foto AS 'fotoCliente', T.fotoPerfil AS 'fotoTaller'");
        $builder->join("taller T", "T.idTaller = U.idUsuario", "left");
        $builder->join("cliente C", "C.idCliente = U.idUsuario", "left");
        $where = "U.rol != 1 AND U.estado = 1";
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Update
     * ---
     * Update cambia el valor del estado de un usuario
     * 
     * @param int $idUsuario
     * @param date $fechaActualizacion
     */
    public function BanUsuario($idUsuario, $fechaActualizacion)
    {
        $builder = $this->db->table('usuario');
        $builder->set('estado', 0);
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idUsuario', $idUsuario);
        return $builder->update();
    }
}