<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\ClienteModel;

class Usuario extends BaseController
{
    public function index()
    {
    	echo view('master/header');
        echo view('usuario/loginView');
        echo view('master/footer');
    } 
    public function Login()
    {
        $MessageReport = session('messageReport');
        $data = [
            "messageReport" => $MessageReport
        ];
    	echo view('master/header');
        echo view('usuario/loginView', $data);
        echo view('master/footer');
    }
    public function Activacion($key)
    {
        //echo $key;
        $usuarioModel = new UsuarioModel();
        $usuarioModel->UpdateVerificado($key);
        $url = base_url('public/usuario/login');
        return redirect()->to($url)->with('messageReport','3');
    }

    public function validacionLogin()
    {
        $session = session();

        if (!$session->has('rol')) 
        {
            $email = $this->request->getPost('txtEmail');
            $password = $this->request->getPost('txtPassword');

            $usuarioModel = new UsuarioModel();
            $data = $usuarioModel->SelectLoginValidacion($email, $password);
            if ($data->getResult()) 
            {
                foreach ($data->getResult() as $row) 
                {
                    if ($row->estado == 0) {
                        $url = base_url('public/usuario/login');
                        return redirect()->to($url);
                    }
                    else 
                    {
                        if ($row->rol == 2) 
                        {
                            $clienteModel = new ClienteModel();
                            $dataCliente = $clienteModel->SelectById($row->idUsuario);

                            if ($dataCliente->getResult()) 
                            {
                                foreach ($dataCliente->getResult() as $row2) 
                                {
                                    $nombre = $row2->nombres.' '.$row2->primerApellido.' '.$row2->segundoApellido;
                                    $session->set('nombre', $nombre);
                                    $session->set('foto', $row2->foto);
                                }
                                $session->set('id', $row->idUsuario);
                                $session->set('rol', 2);
                            }
                        }
                        if ($row->rol == 3) 
                        {
                            $session->set('rol', 3);
                        }
                            
                    }
                }
                if($session->get('rol') == '1')
                {
                    $url = base_url('public/curso/listaCursosAdmin');
                    return redirect()->to($url);
                }
                if ($session->get('rol') == '2') 
                {
                    $url = base_url('public/');
                    return redirect()->to($url);
                }
                if($session->get('rol') == '3')
                {
                    $url = base_url('public/');
                    return redirect()->to($url);
                }
                
            } 
            else 
            {
                $url = base_url('public/usuario/login');
                return redirect()->to($url)->with('messageReport','1');
            }
        } 
        else 
        {
            $url = base_url('public/');
            return redirect()->to($url);
        }

    }
    public function Logout()
    {
        $session = session();
        $session->remove('rol');
        $session->remove('id');
        $session->remove('nombre');
        $session->remove('foto');
        $url = base_url('public/');
        return redirect()->to($url);
    }
}