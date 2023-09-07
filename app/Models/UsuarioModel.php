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
    /**
     * ---
     * Update
     * ---
     * Update cambia el valor de key
     * 
     * @param int $key
     * @param string $email
     */
    public function UpdateKeyRecuperar($key,$email)
    {
        $builder = $this->db->table('usuario');
        $builder->set('key', $key);
        $builder->where('email', $email);
        return $builder->update();
    }
    /**
     * ---
     * Update
     * ---
     * Update cambia los datos de un usuario
     * 
     * @param int $idUsuario
     * @param string $password
     * @param date $fechaActualizacion
     */
    public function UpdatePasswordKey($key, $password, $fechaActualizacion)
    {
        $builder = $this->db->table('usuario');
        $builder->set('password', md5($password));
        $builder->set('key', 'usado');
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('key', $key);
        return $builder->update();
    }
    /**
     * ---
     * Select
     * ---
     * Retorna un valor si el usuario y contraseña coninciden
     */
    public function VerificarPassword($idUsuario, $password)
    {
        $builder = $this->db->table('usuario');
        $builder->select("email");
        $builder->where("idUsuario", $idUsuario);
        $builder->where("password", md5($password));
        $query = $builder->get();
        return $query->getResult();
    }

    /**
     * ---
     * Update
     * ---
     * Update cambia los datos de un usuario
     * 
     * @param int $idUsuario
     * @param string $password
     */
    public function UpdatePassword($idUsuario, $passwordNueva, $fechaActualizacion)
    {
        $builder = $this->db->table('usuario');
        $builder->set('password', md5($passwordNueva));
        $builder->set('fechaActualizacion', $fechaActualizacion);
        $builder->where('idUsuario', $idUsuario);
        return $builder->update();
    }
}