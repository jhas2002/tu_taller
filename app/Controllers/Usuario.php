<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\ClienteModel;
use App\Models\TallerModel;

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
                            $tallerModel = new tallerModel();
                            $dataTaller = $tallerModel->SelectById($row->idUsuario);
                            if ($dataTaller->getResult()) 
                            {
                                foreach ($dataTaller->getResult() as $row2) 
                                {
                                    $nombre = $row2->nombre;
                                    $session->set('nombre', $nombre);
                                    $session->set('foto', $row2->fotoPerfil);
                                }
                            }
                            $session->set('id', $row->idUsuario);
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
    public function recuperarContraseña()
    {
        $session = session();
        $messageReport = session('messageReport');
        $data['messageReport']= $messageReport;
        echo view('master/header');
        echo view('usuario/recuperarContraseñaView', $data);
        echo view('master/footer');
    }
    public function enviarCodigo()
    {
        $email = $this->request->getPost('email');
        $number = random_int(1000000, 9999999);
        $key = md5($number);

        $usuarioModel = new UsuarioModel();
        if ($usuarioModel->EmailExists($email)) 
        {
            $usuarioModel->UpdateKeyRecuperar($key,$email);
            $mail = \Config\Services::email();
            $mail->setFrom('tuTaller@gmail.com');
            $mail->setTo($email);
            $mail->setSubject('Recuperar Contraseña');
            $mail->setMessage("
            <h1>Recuerar contraseña </h1>
            <p>Para poder cambiar su contraseña haga click en el siguiente boton:</p>
            <br>           
            <a href='http://localhost/tu_taller/public/usuario/nuevacontraseña/" . $key . "'>
            <button>Activar</button>
            </a>
            <br>
            <h3>ADVERTENCIA: </h3>
            <p>Si usted no solicito esta recuperacion de contraseña ignore el mensaje.</p>
            ");

            $mail->send();
            $url = base_url('public/usuario/login');
            return redirect()->to($url)->with('messageReport','4');
        }
        else
        {
            $url = base_url('public/usuario/recuperarcontraseña');
            return redirect()->to($url)->with('messageReport','1');
        }

    }
    public function nuevaContraseña($key)
    {
        $data['key'] = $key;
        echo view('master/header');
        echo view('usuario/cambiarContraseñaRecuperadaView', $data);
        echo view('master/footer');
    }
    public function cambiarPassword()
    {
        $key = $this->request->getPost('key');
        $password = $this->request->getPost('password');
        $fechaActualizacion = date('Y-m-d h:i:s a', time());

        $usuarioModel = new UsuarioModel();
        $usuarioModel->UpdatePasswordKey($key, $password, $fechaActualizacion);


        $url = base_url('public/usuario/login');
        return redirect()->to($url)->with('messageReport','2');
    }
    public function cambiarContraseña()
    {
        $idUsuario = $this->request->getPost('id');
        $password = $this->request->getPost('pswAntigua');
        $passwordNueva = $this->request->getPost('pswNueva');
        $usuarioModel = new UsuarioModel();
        $session = session();
        $rol = session('rol');
        if ($usuarioModel->VerificarPassword($idUsuario, $password)) 
        {
            $fechaActualizacion = date('Y-m-d h:i:s a', time());
            $usuarioModel->UpdatePassword($idUsuario, $passwordNueva, $fechaActualizacion);
            if ($rol == 3) 
            {
                $url = base_url('public/taller/perfilTaller');
                return redirect()->to($url)->with('messageReport','3');
            }
            if ($rol == 2) 
            {
                $url = base_url('public/cliente/perfilCliente');
                return redirect()->to($url)->with('messageReport','3');
            }
            
        }
        else
        {
            if ($rol == 3) 
            {
                $url = base_url('public/taller/perfilTaller');
                return redirect()->to($url)->with('messageReport','2');
            }
            if ($rol == 2) 
            {
                $url = base_url('public/cliente/perfilCliente');
                return redirect()->to($url)->with('messageReport','2');
            }
            
        }
    }
    
}