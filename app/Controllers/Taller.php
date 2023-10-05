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
            $url = base_url('public/taller/registro');
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
        foreach ($dataTaller->getResult() as $row) 
        {
            $data['nombre'] = $row->nombre;
            $data['telefono'] = $row->telefono;
            $data['descripcion'] = $row->descripcion;
            $data['direccion'] = $row->direccion;
            $data['latitud'] = $row->latitud;
            $data['longitud'] = $row->longitud;
        }
        $dataHorario = $tallerModel->SelecHorarioTaller($id);
        $data['horario'] = $dataHorario->getResult();
        $data['messageReport'] = $messageReport;
        $data['dias']= $tallerModel->SelectDia();
        echo view('master/header');
        echo view('taller/perfilTallerView',$data);
        echo view('master/footer');
    }
    public function editarTallerModel()
    {
        $session = session();
        $idUsuario = $this->request->getPost('id');
        $nombre = $this->request->getPost('txtNombre');
        $telefono = $this->request->getPost('txtTelefono');
        $descripcion = $this->request->getPost('txtDescripcion');
        $direccion = $this->request->getPost('txtDireccion');
        $fechaActualizacion = date('Y-m-d h:i:s a', time());

        $tallerModel = new TallerModel();
        $tallerModel->UpdateTaller($idUsuario, $nombre, $telefono, $direccion, $descripcion,$fechaActualizacion);
        $session->set('nombre', $nombre);
        $url = base_url('public/taller/perfilTaller');
        return redirect()->to($url)->with('messageReport','1');
    }
    public function agregarHorarioModal()
    {
        $idUsuario = $this->request->getPost('id');
        $dia = $this->request->getPost('selecDia');
        $horaInicio = $this->request->getPost('selecHoraInicio');
        $horaFin = $this->request->getPost('selecHoraFin');

        $tallerModel = new TallerModel();

        $idDia = $tallerModel->SelecIdDia($dia);

        $respuesta = $tallerModel->InsertHorario($idUsuario, $idDia, $horaInicio, $horaFin);

        if ($respuesta > 0) 
        {
            $url = base_url('public/taller/perfilTaller');
            return redirect()->to($url)->with('messageReport','5');
        }
        else
        {
            $url = base_url('public/taller/perfilTaller');
            return redirect()->to($url)->with('messageReport','6');
        }
    }
    public function deleteHorario()
    {
        $idUsuario = $this->request->getPost('id');
        $dia = $this->request->getPost('txtDia');

        $tallerModel = new TallerModel();

        $idDia = $tallerModel->SelecIdDia($dia);

        $fechaActualizacion = date('Y-m-d h:i:s a', time());

        $respuesta = $tallerModel->DeleteHorario($idUsuario, $idDia, $fechaActualizacion);

        if ($respuesta > 0) 
        {
            $url = base_url('public/taller/perfilTaller');
            return redirect()->to($url)->with('messageReport','7');
        }
        else
        {
            $url = base_url('public/taller/perfilTaller');
            return redirect()->to($url)->with('messageReport','8');
        }
    }
    public function editarHorario()
    {
        $idUsuario = $this->request->getPost('id');
        $dia = $this->request->getPost('txtDia');
        $horaInicio = $this->request->getPost('selecHoraInicio');
        $horaFin = $this->request->getPost('selecHoraFin');

        $tallerModel = new TallerModel();

        $idDia = $tallerModel->SelecIdDia($dia);

        $fechaActualizacion = date('Y-m-d h:i:s a', time());

        $respuesta = $tallerModel->UpdateHorario($idUsuario, $idDia, $horaInicio, $horaFin, $fechaActualizacion);

        if ($respuesta > 0) 
        {
            $url = base_url('public/taller/perfilTaller');
            return redirect()->to($url)->with('messageReport','9');
        }
        else
        {
            $url = base_url('public/taller/perfilTaller');
            return redirect()->to($url)->with('messageReport','10');
        }
    }
    public function cambiarFotoTaller()
    {
        $session = session();
        $idUsuario = $session->get('id');
        $fechaActualizacion = date('Y-m-d h:i:s a', time());
        if (move_uploaded_file($_FILES["imgUsuario"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"].'/tu_taller/sources/images/usuario/'.$idUsuario.'.jpg')) 
        {
            $tallerModel = new TallerModel();
            $tallerModel->UpdateTallerFoto($idUsuario,$fechaActualizacion);
            $url = base_url('public/taller/perfilTaller');
            $session->set('foto', '1');
            return redirect()->to($url)->with('messageReport','4');
        }
    }
    public function listaServicio()
    {
        $session = session();
        $idUsuario = $session->get('id');
        $messageReport = session('messageReport');

        $servicioTallerModel = new ServicioTallerModel();
        $servicioModel = new ServicioModel();

        $data['listaServicios']= $servicioModel->SelectServicio();
        $data['servicios'] = $servicioTallerModel->SelectServiciosTaller($idUsuario);
        $data['messageReport'] = $messageReport; 
        $data['id'] = $idUsuario;
        echo view('master/header');
        echo view('servicio/listaServicioView', $data);
        echo view('master/footer');
    }

    public function agregarServicioTallermodel()
    {
        $idUsuario = $this->request->getPost('id');
        $servicio = $this->request->getPost('selecServicio');

        $tallerModel = new TallerModel();
        $servicioModel = new ServicioModel();
        $servicioTallerModel = new ServicioTallerModel();

        $idServicio = $servicioModel->SelecIdServicio($servicio);

        if (!$servicioTallerModel->ServicioExists($idServicio, $idUsuario)) 
        {
            $respuesta = $servicioTallerModel->InsertServicioTaller($idServicio, $idUsuario);
            if ($respuesta > 0) 
            {
                $url = base_url('public/taller/listaServicio');
                return redirect()->to($url)->with('messageReport','1');
            }
            else
            {
                $url = base_url('public/taller/listaServicio');
                return redirect()->to($url)->with('messageReport','2');
            }
        }
        else
        {
            $url = base_url('public/taller/listaServicio');
            return redirect()->to($url)->with('messageReport','3');
        }

        
    }

    public function deshabilitarServicioModel()
    {
        $idUsuario = $this->request->getPost('id');
        $servicio = $this->request->getPost('txtServicioDeshabilitar');

        $servicioTallerModel = new ServicioTallerModel();

        $fechaActualizacion = date('Y-m-d h:i:s a', time());

        $respuesta = $servicioTallerModel->UpdateServicioTaller($idUsuario, $servicio, $fechaActualizacion, 0);

        if ($respuesta > 0) 
        {
            $url = base_url('public/taller/listaServicio');
            return redirect()->to($url)->with('messageReport','4');
        }
        else
        {
            $url = base_url('public/taller/listaServicio');
            return redirect()->to($url)->with('messageReport','5');
        }
    }
    public function habilitarServicioModel()
    {
        $idUsuario = $this->request->getPost('id');
        $servicio = $this->request->getPost('txtServicioHabilitar');

        $servicioTallerModel = new ServicioTallerModel();

        $fechaActualizacion = date('Y-m-d h:i:s a', time());

        $respuesta = $servicioTallerModel->UpdateServicioTaller($idUsuario, $servicio, $fechaActualizacion, 1);

        if ($respuesta > 0) 
        {
            $url = base_url('public/taller/listaServicio');
            return redirect()->to($url)->with('messageReport','6');
        }
        else
        {
            $url = base_url('public/taller/listaServicio');
            return redirect()->to($url)->with('messageReport','7');
        }
    }
    public function listaTaller()
    {
        $tallerModel = new tallerModel();
        $data['talleres'] = $tallerModel->SelectTalleres();
        $messageReport = session('messageReport');
        $data['messageReport'] = $messageReport;
        echo view('master/header');
        echo view('taller/listaTallerView', $data);
        echo view('master/footer');
    }
    public function detalleTaller()
    {
        $idTaller = $this->request->getPost('taller');
        $tallerModel = new TallerModel();
        $servicioTallerModel = new ServicioTallerModel();
        $dataTaller = $tallerModel->SelectById($idTaller);
        foreach ($dataTaller->getResult() as $row) 
        {
            $data['nombre'] = $row->nombre;
            $data['telefono'] = $row->telefono;
            $data['descripcion'] = $row->descripcion;
            $data['direccion'] = $row->direccion;
            $data['latitud'] = $row->latitud;
            $data['longitud'] = $row->longitud;
            $data['foto'] = $row->fotoPerfil;
            $data['idTaller'] = $idTaller;
        }
        $dataHorario = $tallerModel->SelecHorarioTaller($idTaller);
        $data['horario'] = $dataHorario->getResult();
        $data['servicios'] = $servicioTallerModel->SelectServiciosTaller($idTaller);
        echo view('master/header');
        echo view('taller/detalleTallerView', $data);
        echo view('master/footer');
    }
}