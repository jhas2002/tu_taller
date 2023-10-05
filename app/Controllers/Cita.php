<?php

namespace App\Controllers;

use App\Models\CitaModel;
use App\Models\TallerModel;
use App\Models\ServicioModel;
use App\Models\ClienteModel;

class Cita extends BaseController
{
    public function index()
    {
        echo view('master/header');
        echo view('paginaPrincipal');
        echo view('master/footer');
    }
    public function solicitarCita()
    {
        $idTaller = $this->request->getPost('id');
        $servicio = $this->request->getPost('selecServicio');
		$fechaPreferida = $this->request->getPost('fechaPreferida');
        $descripcion = $this->request->getPost('txtDescripcion');

        $citaModel = new CitaModel();
        $servicioModel = new ServicioModel();

        $session = session();
        $idCliente = $session->get('id');

        $idServicio = $servicioModel->SelecIdServicio($servicio);

        $respuesta = $citaModel->InsertCita($descripcion, $fechaPreferida, 0, $idTaller, $idCliente, $idServicio);

        if ($respuesta > 0) 
        {
            $url = base_url('public/taller/listaTaller');
            return redirect()->to($url)->with('messageReport','1');
        }
        else
        {
            $url = base_url('public/taller/listaTaller');
            return redirect()->to($url)->with('messageReport','2');
        }
    }
    public function listaCitaTaller()
    {
        $session = session();
        $idUsuario = $session->get('id');
        $messageReport = session('messageReport');

        $cita = new CitaModel();
        
        $data['citas'] = $cita->SelectCitasTaller($idUsuario);
        $data['messageReport'] = $messageReport; 
        $data['id'] = $idUsuario;
        echo view('master/header');
        echo view('cita/listaCitasView', $data);
        echo view('master/footer');
    }
    public function listaCitaPendienteTaller()
    {
        $session = session();
        $idUsuario = $session->get('id');
        $messageReport = session('messageReport');

        $cita = new CitaModel();
        
        $data['citas'] = $cita->SelectCitasTallerPendiente($idUsuario);
        $data['messageReport'] = $messageReport; 
        $data['id'] = $idUsuario;
        echo view('master/header');
        echo view('cita/listaCitasPendientesView', $data);
        echo view('master/footer');
    }
    public function aceptarCita()
    {
        $idCliente = $this->request->getPost('idCliente');
        $idCita = $this->request->getPost('idCita');
        $fechaCita = $this->request->getPost('fechaCita');

        $citaModel = new CitaModel();
        $clienteModel = new ClienteModel();

        $fechaActualizacion = date('Y-m-d h:i:s a', time());
        $email = $clienteModel->SelectEmailById($idCliente);
        $respuesta = $citaModel->UpdateCitaEstadoFecha($idCita, $fechaCita, 1, $fechaActualizacion);

        if ($respuesta > 0) 
        {


        	$mail = \Config\Services::email();
           	$mail->setFrom('autotestproy@gmail.com');
           	$mail->setTo($email);
           	$mail->setSubject('Cita Aceptada');
           	$mail->setMessage("
           	<h2>Su cita a sido aceptada es el dia:</h2>
           	<h1>".$fechaCita."</h1>
           	<br>           
           	</a>");
           	$mail->send();

            $url = base_url('public/cita/listacitapendientetaller');
            return redirect()->to($url)->with('messageReport','1');
        }
        else
        {
            $url = base_url('public/cita/listacitapendientetaller');
            return redirect()->to($url)->with('messageReport','2');
        }
    }
    public function rechazarCita()
    {
        $idCliente = $this->request->getPost('idCliente');
        $idCita = $this->request->getPost('idCita');
        $motivo = $this->request->getPost('txtMotivo');

        $citaModel = new CitaModel();
        $clienteModel = new ClienteModel();

        $fechaActualizacion = date('Y-m-d h:i:s a', time());
        $email = $clienteModel->SelectEmailById($idCliente);
        $respuesta = $citaModel->UpdateCitaEstadoRechazar($idCita, -1, $fechaActualizacion);

        if ($respuesta > 0) 
        {


        	$mail = \Config\Services::email();
           	$mail->setFrom('autotestproy@gmail.com');
           	$mail->setTo($email);
           	$mail->setSubject('Cita Rechazada');
           	$mail->setMessage("
           	<h2>Su cita a sido rechazada por el siguiente motivo:</h2>
           	<p>".$motivo."</p>
           	<br>           
           	</a>");
           	$mail->send();

            $url = base_url('public/cita/listacitapendientetaller');
            return redirect()->to($url)->with('messageReport','3');
        }
        else
        {
            $url = base_url('public/cita/listacitapendientetaller');
            return redirect()->to($url)->with('messageReport','4');
        }
    }
}
