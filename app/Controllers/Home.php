<?php


namespace App\Controllers;

use App\Models\ForoModel;

class Home extends BaseController
{
    public function index()
    {

        $foroModel = new ForoModel();

        $list = [];
        $dataPreguntas = $foroModel->SelectPreguntasForoMain();
        foreach ($dataPreguntas as $row) {
            $respuestas = $foroModel->SelectRespuestasMain($row->idForo);
            $pregunta = [
                'pregunta' => $row->pregunta,
                'nombre' => $row->nombre,
                'foto' => $row->foto,
                'idUsuario' => $row->idUsuario,
                'respuestas' => $respuestas
            ];
            array_push($list, $pregunta);
        }
        $data['foro']= $list;

        echo view('master/header');
        echo view('paginaPrincipal', $data);
        echo view('master/footer');
    }
}
