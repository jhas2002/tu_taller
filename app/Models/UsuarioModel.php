<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
	/**
     * ---
     * Select
     * ---
     * Retorna un email si existe
     */
    public function EmailExists($email)
    {
        $builder = $this->db->table('usuario');
        $builder->select("email");
        $builder->where("email", $email);
        $query = $builder->get();
        return $query->getResult();
    }

    /**
     * ---
     * Select
     * ---
     * Retorna el siguiente id del usuario
     * @return int
     */
    public function SelectNext()
    {
        $builder = $this->db->table('usuario');
        $builder->select("IFNULL(MAX(idUsuario) + 1, 1) AS next");
        $query = $builder->get();
        $res = 0;
        foreach ($query->getResult() as $row) {
            $res = $row->next;
        }
        return $res;
    }

    /**
     * ---
     * Insert
     * ---
     * Inserta los datos de usuario en la base de datos 
     * 
     * @param int $idUsuario
     * @param string $nombreUsuario
     * @param string $email
     * @param string $key
     * @param string $contraseña
     * @param string $Rol
     */
    public function InsertUsuario($idUsuario,$password, $email, $key, $rol)
    {
        
        $builder = $this->db->table('usuario'); 
        $data = [
            'idUsuario' => $idUsuario,
            'password' => md5($password),
            'email' => $email,
            'key' => $key,
            'rol' => $rol,
        ];
        $query = $builder->insert($data);
        return $query;
    }
    /**
     * ---
     * Update
     * ---
     * Update el campo verificado a 1
     * 
     * @param int $key
     */
    public function UpdateVerificado($key)
    {
        $builder = $this->db->table('usuario');
        $builder->set('verificado', 1);
        $builder->where('key', $key);
        return $builder->update();
    }
    /**
     * ---
     * Select
     * ---
     * Retorna los datos del usuario por correo o usuario y contraseña
     * 
     * @param string $email
     * @param string $password sin encriptar
     */
    public function SelectLoginValidacion($email, $password)
    {
        $builder = $this->db->table('usuario');
        $builder->select("*");
        $builder->where('email', $email);
        $builder->where('password', md5($password));
        $builder->where('verificado', 1);
        $query = $builder->get();
        return $query;
    }
}