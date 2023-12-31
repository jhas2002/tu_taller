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
    /**
     * ---
     * Select
     * ---
     * Retorna los datos del cliente para el pdf
     * 
     * @param int $id
     */
    public function SelectByIdPDF($idCliente)
    {
        $builder = $this->db->table('cliente C');
        $builder->select("CONCAT(C.nombres,' ',C.primerApellido, ' ',C.segundoApellido) AS 'nombre', C.celular AS 'celular', U.email AS 'email'");
        $builder->join("usuario U", "U.idUsuario = C.idCliente", "inner");
        $builder->where('C.idCliente', $idCliente);
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
    public function UpdateClienteFoto($idUsuario,$fechaActualizacion)
    {
        $builder = $this->db->table('cliente');
        $builder->set('foto', '1');
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idCliente', $idUsuario);
        return $builder->update();
    }

    /**
     * ---
     * Update
     * ---
     * Update cambia los datos de un cliente
     * 
     * @param int $idUsuario
     * @param string $nombre
     * @param string $primerApellido
     * @param string $segundoApellido
     * @param string $telefono
     * @param date $fechaActualizacion
     */
    public function UpdateCliente($idUsuario, $nombre, $primerApellido, $segundoApellido, $telefono,$fechaActualizacion)
    {
        $builder = $this->db->table('cliente');
        $builder->set('nombres', $nombre);
        $builder->set('primerApellido', $primerApellido);
        $builder->set('segundoApellido', $segundoApellido);
        $builder->set('celular', $telefono);
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idCliente', $idUsuario);
        return $builder->update();
    }
    /**
     * ---
     * Select
     * ---
     * Retorna el email del cliente
     * @return int
     */
    public function SelectEmailById($idCliente)
    {
        $builder = $this->db->table('usuario');
        $builder->select("email");
        $builder->where("idUsuario", $idCliente);
        $query = $builder->get();
        $res = 0;
        foreach ($query->getResult() as $row) {
            $res = $row->email;
        }
        return $res;
    }
}