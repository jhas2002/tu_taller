<?php

namespace App\Models;

use CodeIgniter\Model;

class ForoModel extends Model
{
    /**
     * ---
     * Insert
     * ---
     * Inserta una pregunta en la base de datos.  
     * 
     * @param string $pregunta
     */
    public function InsertPregunta($pregunta, $idUsuario)
    {
        $builder = $this->db->table('foro');
        $data = [
            'pregunta' => $pregunta,
            'idUsuario' => $idUsuario
        ];
        $query = $builder->insert($data);
        return $query;
    }
    /**
     * ---
     * Select
     * ---
     * Retorna los datos de las preguntas para el foro
     * 
     * 
     */
    public function SelectPreguntasForo()
    {
        $builder = $this->db->table('foro F');
        $builder->select("F.pregunta AS 'pregunta', F.idForo AS 'idForo',C.foto AS 'foto',CONCAT(C.nombres,' ',C.primerApellido, ' ',C.segundoApellido) AS 'nombre', F.idUsuario AS 'idUsuadio', (SELECT COUNT(CM.idForo) FROM comentario CM WHERE CM.idForo = F.idForo) AS 'respuestas'");
        $builder->join("usuario U", "U.idUsuario = F.idUsuario", "inner");
        $builder->join("cliente C", "C.idCliente = U.idUsuario", "inner");
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Select
     * ---
     * Retorna los datos de una pregunta especifica
     * 
     * 
     */
    public function SelectPreguntaForo($idForo)
    {
        $builder = $this->db->table('foro F');
        $builder->select("F.pregunta AS 'pregunta', CONCAT(C.nombres,' ',C.primerApellido, ' ',C.segundoApellido) AS 'nombre', C.foto AS 'foto', U.idUsuario AS 'idUsuario'");
        $builder->join("usuario U", "U.idUsuario = F.idUsuario", "inner");
        $builder->join("cliente C", "C.idCliente = U.idUsuario", "inner");
        $builder->where("F.idForo", $idForo);
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Select
     * ---
     * Retorna los dato de las repuestas
     * 
     * 
     */
    public function SelectRespuestas($idForo)
    {
        $builder = $this->db->table('comentario C');
        $builder->select("C.descripcion AS 'comentario', CONCAT(CL.nombres,' ',CL.primerApellido, ' ',CL.segundoApellido) AS 'nombre', C.fechaCreacion AS 'fechaRegistro', CL.foto AS 'foto', U.idUsuario AS idUsuario");
        $builder->join("usuario U", "U.idUsuario = C.idUsuario", "inner");
        $builder->join("cliente CL", "CL.idCliente = U.idUsuario", "inner");
        $builder->where("C.idForo", $idForo);
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Insert
     * ---
     * Inserta un comentario a una pregunta 
     * 
     * @param string $idForo
     * @param string $idUsuario
     * @param string $comentario
     */
    public function InsertComentario($idForo, $idUsuario, $comentario)
    {
        $builder = $this->db->table('comentario');
        $data = [
            'idUsuario' => $idUsuario,
            'idForo' => $idForo,
            'descripcion' => $comentario
        ];
        $query = $builder->insert($data);
        return $query;
    }
}