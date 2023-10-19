<?php

namespace App\Controllers;

use App\Models\TallerModel;
use App\Models\CalificarModel;

class Calificar extends BaseController
{
    public function index()
    {
        echo view('master/header');
        echo view('paginaPrincipal');
        echo view('master/footer');
    }
    public function registrarCalificacion()
    {
        $session = session();
        $idTaller = $this->request->getPost('idTaller');
        $calificacion = $this->request->getPost('calificacion');
        $idCliente = $session->get('id');
        $fechaActualizacion = date('Y-m-d h:i:s a', time());

        $calificarModel = new CalificarModel();

        if (!$calificarModel->CalificacionExist($idTaller, $idCliente)) 
        {
            
            
            $respuesta = $calificarModel->InsertCalificacion($idTaller, $idCliente, $calificacion);
            if ($respuesta > 0) 
            {
                $url = base_url('public/taller/listaTaller');
                return redirect()->to($url)->with('messageReport','5');
            }
            else
            {
                $url = base_url('public/taller/listaTaller');
                return redirect()->to($url)->with('messageReport','6');
            }
        }
        else
        {
            $respuesta = $calificarModel->UpdateCalificacion($idTaller, $idCliente, $calificacion, $fechaActualizacion);
            if ($respuesta > 0) 
            {
                $url = base_url('public/taller/listaTaller');
                return redirect()->to($url)->with('messageReport','5');
            }
            else
            {
                $url = base_url('public/taller/listaTaller');
                return redirect()->to($url)->with('messageReport','6');
            }
        }

        
    } 
}