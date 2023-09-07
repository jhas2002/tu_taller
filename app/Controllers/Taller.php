<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\ServicioModel;
use App\Models\TallerModel;
use App\Models\ServicioTallerModel;

class Taller extends BaseController
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

        $servicioModel = new ServicioModel();
        $tallerModel = new TallerModel();

        $data['servicios']= $servicioModel->SelectServicio();
        $data['dias']= $tallerModel->SelectDia();

        $data['messageReport']= $messageReport;

    	echo view('master/header');
        echo view('taller/registroView', $data);
        echo view('master/footer');
    }
    public function registrarModel()
    {
        //Datos Usuario
        $email= $this->request->getPost('txtEmail');
        $password = $this->request->getPost('txtPassword');

        //Datos Taller
        $nombre = $this->request->getPost('txtNombre');
        $telefono= $this->request->getPost('txtNumeroTelefono');
        $descripcion = $this->request->getPost('txtDescripcion');
        $direccion = $this->request->getPost('txtDireccion');
        $latitud = $this->request->getPost('txtLatitud');
        $longitud = $this->request->getPost('txtLongitud');
        $horario = $this->request->getPost('txtHorario');
        $servicio = $this->request->getPost('txtServicio');
        $photo = $this->request->getFile('photo');

        $usuarioModel = new UsuarioModel();
        $tallerModel = new TallerModel();
        $servicioModel = new ServicioModel();
        $servicioTallerModel = new ServicioTallerModel();


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
            $usuarioModel->InsertUsuario($idUsuario,$password, $email, $key,'3');
            $respuesta = $tallerModel->InsertTaller($idUsuario, $nombre,$telefono, $descripcion,$direccion,$latitud,$longitud,$hasPhoto);


            $separar = explode("\r\n",$servicio);
            $servicios = '';
            for ($i=0; $i < count($separar); $i++) 
            { 
                $servicios = $servicioModel->SelecIdServicio($separar[$i]);
                if ($servicios != 0) 
                {
                    $servicioTallerModel->InsertServicioTaller($servicios, $idUsuario);
                }
                
            }
            $separarHorario = explode("\r\n", $horario);
            $dias = '';
            for ($i=0; $i < count($separarHorario) ; $i++) 
            { 

                $dias = explode(" ", $separarHorario[$i]);
                $diasBDD = $tallerModel->SelecIdDia($dias[0]);
                if ($diasBDD != 0) 
                {
                    echo $diasBDD;
                    $tallerModel->InsertHorario($idUsuario, $diasBDD, $dias[1], $dias[3]);
                    
                }
                
            }

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

                $url = base_url('public/taller/registro');
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
    public function perfilTaller()
    {
        $session = session();
        $messageReport = session('messageReport');
        $id = $session->get('id');
        $data['id'] = $id;
        $tallerModel = new TallerModel();
        $dataTaller = $tallerModel->SelectById($id);
        /*foreach ($dataTaller as $row) 
        {
            $data['nombre'] = $row->nombre;
            $data['primerApellido'] = $row->primerApellido;
            $data['segundoApellido'] = $row->segundoApellido;
            $data['email'] = $row->email;
            $data['telefono'] = $row->telefono;
            $data['ocupacion'] = $row->ocupacion;
            $data['departamento'] =$row->departamento;
        }*/
        $data['messageReport'] = $messageReport;
        echo view('master/header');
        echo view('taller/perfilTallerView',$data);
        echo view('master/footer');
    }
}