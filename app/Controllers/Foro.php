<?php  

namespace App\Controllers;
use App\Models\ForoModel;

date_default_timezone_set('America/La_Paz');

class Foro extends BaseController
{
    public function index()
    {
        echo view('master/header');
        echo view('foro/listaForoView');
        echo view('master/footer');
    }
    public function listaForo()
    {
        $session = session();
        $messageReport = session('messageReport');
        $data['messageReport'] = $messageReport;

        $foroModel = new ForoModel();
        $dataForo = $foroModel->SelectPreguntasForo();
        $data['preguntas'] = $dataForo;

    	echo view('master/header');
        echo view('foro/listaForoView',$data);
        echo view('master/footer');
    }

    public function detalleForo()
    {
        $session = session();

        $idForo = $this->request->getPost('foro');
        if (session('mensaje') != null) 
        {
            $idForo = session('mensaje');
        }
        $foroModel = new ForoModel();

        $dataPregunta = $foroModel->SelectPreguntaForo($idForo);
        foreach ($dataPregunta as $row) 
        {
            
            $data['pregunta'] = $row->pregunta;
            $data['idUsuario'] = $row->idUsuario;
            if ($row->rol == '2') {
                $data['foto'] = $row->foto;
                $data['nombre'] = $row->cliente;
            }
            else{
                $data['foto'] = $row->fotoTaller;
                $data['nombre'] = $row->taller;
            }
            
        }
        $data['respuestas'] = $foroModel->SelectRespuestas($idForo);

        $data['idForo'] = $idForo;
        echo view('master/header');
        echo view('foro/detalleForoView', $data);
        echo view('master/footer');
    }
    public function comentarioForo()
    {
        $session = session();
        $comentario = $this->request->getPost('comentario');
        $idForo = $this->request->getPost('pregunta');
        $idUsuario = $session->get('id');

        $foroModel = new ForoModel();
        $foroModel->InsertComentario($idForo, $idUsuario, $comentario);

        $url = base_url('public/foro/detalleForo');
        return redirect()->to($url)->with('mensaje', $idForo);


    }
    public function registrarPregunta()
    {
        $session = session();
        if ($session->get('rol') == '2' || $session->get('rol') == '3') 
        {
            $pregunta = $this->request->getPost('txtPregunta');
            $idUsuario = $session->get('id');

            $foroModel = new ForoModel();
            $foroModel->InsertPregunta($pregunta, $idUsuario);
            $url = base_url('public/foro/listaForo');
            return redirect()->to($url)->with('messageReport','1');
        }
        else
        {
            $url = base_url('public/');
            return redirect()->to($url);
        }
        


    }
}