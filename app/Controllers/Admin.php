<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CalificarModel;

class Admin extends BaseController
{
    public function index()
    {
        echo view('master/header');
        echo view('paginaPrincipal');
        echo view('master/footer');
    }
    public function listaUsuarios()
    {
        $adminModel = new AdminModel();
        $data['usuarios'] = $adminModel->SelectUsuarios();
        $messageReport = session('messageReport');
        $data['messageReport'] = $messageReport;
        echo view('master/header');
        echo view('admin/listaUsuariosView', $data);
        echo view('master/footer');
    }
    public function banearUsuario()
    {
        $session = session();
        $idUsuario = $this->request->getPost('idUsuario');
        $fechaActualizacion = date('Y-m-d h:i:s a', time());

        $adminModel = new AdminModel();

        $respuesta = $adminModel->BanUsuario($idUsuario, $fechaActualizacion);
        if ($respuesta > 0) 
        {
            $url = base_url('public/admin/listaUsuarios');
            return redirect()->to($url)->with('messageReport','1');
        }
        else
        {
            $url = base_url('public/admin/listaUsuarios');
            return redirect()->to($url)->with('messageReport','2');
        }

        
    } 
}