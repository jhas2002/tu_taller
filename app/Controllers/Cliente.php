<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\ClienteModel;

class Cliente extends BaseController
{
    public function index()
    {
    	echo view('master/header');
        echo view('usuario/loginView');
        echo view('master/footer');
    } 
    public function registro()
    {
        $session = session();
        $messageReport = session('messageReport');

        $data['messageReport']= $messageReport;

    	echo view('master/header');
        echo view('cliente/registroView', $data);
        echo view('master/footer');
    }
    public function registrarModel()
    {
        //Datos Usuario
        $email= $this->request->getPost('txtEmail');
        $password = $this->request->getPost('txtPassword');
        //Datos Cliente
        $nombres = $this->request->getPost('txtNombre');
        $primerApellido= $this->request->getPost('txtPrimerApellido');
        $segundoApellido= $this->request->getPost('txtSegundoApellido');
        $celular= $this->request->getPost('txtNumeroCelular');
        $photo = $this->request->getFile('photo');


        $separar = explode(' ',$nombres);
        $nombres = '';
        for ($i=0; $i < count($separar); $i++) 
        { 
            $nombres = $nombres.ucfirst(strtolower($separar[$i])).' ';
        }
        $primerApellido = ucfirst(strtolower($primerApellido));
        $segundoApellido = ucfirst(strtolower($segundoApellido));

        $usuarioModel = new UsuarioModel();
        $clienteModel = new ClienteModel();

        //verificacion de email
        if (!$usuarioModel->EmailExists($email)) 
        {
            // seleccionando id
            $idUsuario = $usuarioModel->SelectNext();

            //generando key
            $number = random_int(1000000, 9999999);
            $key = md5($number);

            //Guardar foto

            $hasPhoto = 0;
            if ($photo != "") 
            {
                $file = $this->validate([
                    'file' => [
                        'rules' => 'uploaded[photo]'
                        . '|is_image[photo]'
                        . '|mime_in[photo,image/jpg,image/jpeg]'
                    ]
                ]);
                if (!$file) 
                {
                    echo ('El archivo está dañado o no tiene el formato correcto, solo se aceptan archivos con extención .jpg');
                } 
                else 
                {
                    $target_dir = '../sources/images/usuario/';
                    $file = $_FILES['photo']['name'];
                    $path = pathinfo($file);
                    $filename = $idUsuario;
                    $ext = $path['extension'];
                    $temp_name = $_FILES['photo']['tmp_name'];
                    $path_filename_ext = $target_dir . $filename . "." . $ext;
                    move_uploaded_file($temp_name, $path_filename_ext);
                    $hasPhoto = 1;
                }
            }

            

            //registrando cliente 
            $usuarioModel->InsertUsuario($idUsuario,$password, $email, $key,'2');
            $respuesta = $clienteModel->InsertCliente($idUsuario, $nombres,$primerApellido, $segundoApellido,$celular, $hasPhoto);

            // verificando la insercion 

            if ($respuesta > 0) 
            {
                $mail = \Config\Services::email();
                $mail->setFrom('autotestproy@gmail.com');
                $mail->setTo($email);
                $mail->setSubject('Activación de correo');
                $mail->setMessage("
                <h1>Gracias por registrarse en Tu Taller</h1>
                <p>haga click en Activar para poder usar su cuenta</p>
                <br>           
                <a href='http://localhost/tu_taller/public/usuario/activacion/" . $key . "'>
                <button>Activar</button>
                </a>");
                $mail->send();

                $url = base_url('public/cliente/registro');
                return redirect()->to($url)->with('messageReport','1');
            }
            else
            {
                echo "ERROR";
            }
        }
        else
        {
            $url = base_url('public/cliente/registro');
            return redirect()->to($url)->with('messageReport','2');
        }        
    }
}