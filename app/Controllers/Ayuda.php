<?php  

namespace App\Controllers;
use App\Models\AyudaModel;
use App\Models\TallerModel;

date_default_timezone_set('America/La_Paz');

class Ayuda extends BaseController
{
    public function index()
    {
        echo view('master/header');
        echo view('foro/listaForoView');
        echo view('master/footer');
    }
    public function mapaAyuda()
    {
        $session = session();
        $messageReport = session('messageReport');
        $data['messageReport'] = $messageReport;
        $tallerModel = new TallerModel();

        $data['talleres'] = $tallerModel->SelectTalleresAyuda();

    	echo view('master/header');
        echo view('ayuda/mapaAyudaView',$data);
        echo view('master/footer');
    }
    public function solicitarAyuda()
    {
        $session = session();
        $messageReport = session('messageReport');
        $idTaller = $this->request->getPost('idTaller');
        $descripcionProblema = $this->request->getPost('txtProblema');
        $descripcionAuto = $this->request->getPost('txtDescripcionAuto');
        $latitud = $this->request->getPost('txtLatitud');
        $longitud = $this->request->getPost('txtLongitud');
        $data['messageReport'] = $messageReport;
        $idCliente = $session->get('id');

        $tallerModel = new TallerModel();
        $ayudaModel = new AyudaModel();

        $telefono = $tallerModel->SelecNumeroTaller($idTaller);

        $respuesta = $ayudaModel->InsertAyuda($descripcionProblema, $descripcionAuto,$latitud,$longitud, $idTaller, $idCliente);

        if ($respuesta > 0) 
        {
            $url = base_url('public/ayuda/mapaAyuda');
            return redirect()->to($url)->with('messageReport','1/'.$idCliente.'/'.$latitud.'/'.$longitud.'/'.$telefono);
        }
        else
        {
            $url = base_url('public/ayuda/mapaAyuda');
            return redirect()->to($url)->with('messageReport','2');
        }
    }
    public function listaAyudaTaller()
    {
        $session = session();
        $idUsuario = $session->get('id');
        $messageReport = session('messageReport');

        $ayudaModel = new AyudaModel();
        
        $data['ayudas'] = $ayudaModel->SelectAyudaTaller($idUsuario);
        $data['messageReport'] = $messageReport; 
        $data['id'] = $idUsuario;
        echo view('master/header');
        echo view('ayuda/listaAyudaView', $data);
        echo view('master/footer');
    }

    public function aceptarAyuda()
    {
        $idAyuda = $this->request->getPost('idAyuda');

        $ayudaModel = new AyudaModel();

        $fechaActualizacion = date('Y-m-d h:i:s a', time());

        $respuesta = $ayudaModel->UpdateAyudaEstado($idAyuda, 2, $fechaActualizacion);

        if ($respuesta > 0) 
        {

            $url = base_url('public/ayuda/listaAyudaTaller');
            return redirect()->to($url)->with('messageReport','1');
        }
        else
        {
            $url = base_url('public/ayuda/listaAyudaTaller');
            return redirect()->to($url)->with('messageReport','2');
        }
    }

    public function rechazarAyuda()
    {
        $idAyuda = $this->request->getPost('idAyuda');

        $ayudaModel = new AyudaModel();

        $fechaActualizacion = date('Y-m-d h:i:s a', time());

        $respuesta = $ayudaModel->UpdateAyudaEstado($idAyuda, 0, $fechaActualizacion);

        if ($respuesta > 0) 
        {

            $url = base_url('public/ayuda/listaAyudaTaller');
            return redirect()->to($url)->with('messageReport','3');
        }
        else
        {
            $url = base_url('public/ayuda/listaAyudaTaller');
            return redirect()->to($url)->with('messageReport','4');
        }
    }
    
    
}