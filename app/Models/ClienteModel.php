<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
	/**
     * ---
     * Insert
     * ---
     * Inserta a los datos de un cliente
     * 
     * @param int $id
     * @param string $nombres
     * @param string $primerApellido
     * @param string $segundoApellido
     * @param string $celular
     * @param int $foto
     */
    public function InsertCliente($idUsuario, $nombres,$primerApellido, $segundoApellido,$celular,$foto)
    {
        $builder = $this->db->table('cliente');
        $data = [
            'idCliente' => $idUsuario,
            'nombres' => $nombres,
            'primerApellido' => $primerApellido,
            'segundoApellido' => $segundoApellido,
            'celular' => $celular,
            'foto' => $foto
        ];
        $query = $builder->insert($data);
        return $query;
    }
    /**
     * ---
     * Select
     * ---
     * Retorna los datos del cliente
     * 
     * @param int $id
     */
    public function SelectById($id)
    {
        $builder = $this->db->table('cliente');
        $builder->select("*");
        $builder->where('idCliente', $id);
        $query = $builder->get();
        return $query;
    }
}