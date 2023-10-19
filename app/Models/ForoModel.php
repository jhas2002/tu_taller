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
     * Retorna los datos de las preguntas para el main
     * 
     * 
     */
    public function SelectPreguntasForoMain()
    {
        $builder = $this->db->table('itc_foro F');
        $builder->select("F.itc_pregunta AS 'pregunta', U.itc_nombres AS 'nombre', U.itc_primerApellido AS 'primerApellido', U.itc_segundoApellido AS 'segundoApellido', U.itc_foto AS 'foto', U.itc_idUsuario AS 'idUsuario', F.itc_idForo AS 'idForo'");
        $builder->join("itc_estudiante E", "E.itc_idEstudiante = F.itc_idEstudiante", "inner");
        $builder->join("itc_usuario U", "U.itc_idUsuario = E.itc_idEstudiante", "inner");
        $builder->orderBy('F.itc_fechaRegistro', 'desc');
        $builder->limit('3');
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
        $builder = $this->db->table('itc_foro F');
        $builder->select("F.itc_pregunta AS 'pregunta', U.itc_nombres AS 'nombre', U.itc_primerApellido AS 'primerApellido', U.itc_segundoApellido AS 'segundoApellido', U.itc_foto AS 'foto', U.itc_idUsuario AS 'idUsuario'");
        $builder->join("itc_estudiante E", "E.itc_idEstudiante = F.itc_idEstudiante", "inner");
        $builder->join("itc_usuario U", "U.itc_idUsuario = E.itc_idEstudiante", "inner");
        $builder->where("F.itc_idForo", $idForo);
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
        $builder = $this->db->table('itc_comentario C');
        $builder->select("C.itc_comentario AS 'comentario', U.itc_nombres AS 'nombre', U.itc_primerApellido AS 'primerApellido', U.itc_segundoApellido AS 'segundoApellido', C.itc_fechaRegistro AS 'fechaRegistro', U.itc_foto AS 'foto', U.itc_idUsuario AS idUsuario");
        $builder->join("itc_estudiante E", "E.itc_idEstudiante = C.itc_idEstudiante", "inner");
        $builder->join("itc_usuario U", "U.itc_idUsuario = E.itc_idEstudiante", "inner");
        $builder->where("C.itc_idForo", $idForo);
        $query = $builder->get();
        return $query->getResult();
    }
    /**
     * ---
     * Select
     * ---
     * Retorna los dato de las 2 repuestas
     * 
     * 
     */
    public function SelectRespuestasMain($idForo)
    {
        $builder = $this->db->table('itc_comentario C');
        $builder->select("C.itc_comentario AS 'comentario', U.itc_nombres AS 'nombre', U.itc_primerApellido AS 'primerApellido', U.itc_segundoApellido AS 'segundoApellido', C.itc_fechaRegistro AS 'fechaRegistro', U.itc_foto AS 'foto', U.itc_idUsuario AS 'idUsuario'");
        $builder->join("itc_estudiante E", "E.itc_idEstudiante = C.itc_idEstudiante", "inner");
        $builder->join("itc_usuario U", "U.itc_idUsuario = E.itc_idEstudiante", "inner");
        $builder->where("C.itc_idForo", $idForo);
        $builder->limit('2');
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
        $builder = $this->db->table('itc_comentario');
        $data = [
            'itc_idEstudiante' => $idUsuario,
            'itc_idForo' => $idForo,
            'itc_comentario' => $comentario
        ];
        $query = $builder->insert($data);
        return $query;
    }
}