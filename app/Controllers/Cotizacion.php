<?php

namespace App\Controllers;

use App\Models\TallerModel;
use App\Models\ServicioModel;
use App\Models\ClienteModel;
use App\Models\CotizacionModel;
require_once $_SERVER["DOCUMENT_ROOT"].'/tu_taller/app/libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Cotizacion extends BaseController
{
    public function index()
    {
        echo view('master/header');
        echo view('paginaPrincipal');
        echo view('master/footer');
    }
    public function solicitarCotizacion()
    {
        $idTaller = $this->request->getPost('id');
        $servicio = $this->request->getPost('selecServicio');
        $descripcionProblema = $this->request->getPost('txtDescripcionProblema');

        $cotizacionModel = new CotizacionModel();
        $servicioModel = new ServicioModel();

        $session = session();
        $idCliente = $session->get('id');

        $idServicio = $servicioModel->SelecIdServicio($servicio);

        $respuesta = $cotizacionModel->InsertCotizacion($descripcionProblema, 0, $idTaller, $idCliente, $idServicio);

        if ($respuesta > 0) 
        {
            $url = base_url('public/taller/listaTaller');
            return redirect()->to($url)->with('messageReport','3');
        }
        else
        {
            $url = base_url('public/taller/listaTaller');
            return redirect()->to($url)->with('messageReport','4');
        }
    }

    public function listaCotizacionTaller()
    {
        $session = session();
        $idUsuario = $session->get('id');
        $messageReport = session('messageReport');

        $cotizacionModel = new CotizacionModel();
        
        $data['cotizaciones'] = $cotizacionModel->SelectCotizacionTaller($idUsuario);
        $data['messageReport'] = $messageReport; 
        $data['id'] = $idUsuario;
        echo view('master/header');
        echo view('cotizacion/listaCotizacionView', $data);
        echo view('master/footer');
    }
    public function listaCotizacionPendienteTaller()
    {
        $session = session();
        $idUsuario = $session->get('id');
        $messageReport = session('messageReport');

        $cotizacionModel = new CotizacionModel();
        
        $data['cotizaciones'] = $cotizacionModel->SelectCotizacionTallerPendiente($idUsuario);
        $data['messageReport'] = $messageReport; 
        $data['id'] = $idUsuario;
        echo view('master/header');
        echo view('cotizacion/listaCotizacionPendientesView', $data);
        echo view('master/footer');
    }
    public function realizarCotizacion()
    {
        $idCliente = $this->request->getPost('idCliente');
        $idCotizacion = $this->request->getPost('idCotizacion');
        $descripcionSolucion = $this->request->getPost('txtDescripcion');
        $costo = $this->request->getPost('txtCosto');
        $tiempoAprox = $this->request->getPost('txtTiempoAproximado');

        $cotizacionModel = new CotizacionModel();
        $clienteModel = new ClienteModel();

        $fechaActualizacion = date('Y-m-d h:i:s a', time());
        $email = $clienteModel->SelectEmailById($idCliente);
        $respuesta = $cotizacionModel->UpdateCotizacionRealizada($idCotizacion, $descripcionSolucion, $costo, $tiempoAprox, 1, $fechaActualizacion);

        if ($respuesta > 0) 
        {


        	$mail = \Config\Services::email();
           	$mail->setFrom('autotestproy@gmail.com');
           	$mail->setTo($email);
           	$mail->setSubject('Cotizacion');
           	$mail->setMessage("
           	<h2>Su cotizacion a sido realizada puede revisarla en la pagina web</h2>

           	<br> ");
           	$mail->send();

            $url = base_url('public/cotizacion/listacotizacionpendientetaller');
            return redirect()->to($url)->with('messageReport','1');
        }
        else
        {
            $url = base_url('public/cita/listacotizacionpendientetaller');
            return redirect()->to($url)->with('messageReport','2');
        }
    }
    public function listaCotizacionCliente()
    {
        $session = session();
        $idUsuario = $session->get('id');
        $messageReport = session('messageReport');

        $cotizacionModel = new CotizacionModel();
        
        $data['cotizaciones'] = $cotizacionModel->SelectCotizacionCliente($idUsuario);
        $data['messageReport'] = $messageReport; 
        $data['id'] = $idUsuario;
        echo view('master/header');
        echo view('cotizacion/listaCotizacionClienteView', $data);
        echo view('master/footer');
    }
    public function clienteCotizacionPDF()
    {
        $idCotizacion = $this->request->getPost('idCotizacion');

        $idCliente = 0;
        $idTaller = 0;
        $cotizacionModel = new CotizacionModel();
        $clienteModel = new ClienteModel();
        $tallerModel = new TallerModel();

        $dataCotizacion = $cotizacionModel->SelectCotizacionPDF($idCotizacion);

        foreach ($dataCotizacion as $row) 
        {
            $data['solucion'] = $row->solucion;
            $data['tiempo'] = $row->tiempo;
            $data['costo'] = $row->costo;
            $data['servicio'] = $row->servicio;

            $fechas = str_split($row->fecha,10);
            $data['fecha'] = $fechas[0];

            $idCliente = $row->idCliente;
            $idTaller = $row->idTaller;
        }
        $dataTaller = $tallerModel->SelectByIdPDF($idTaller);
        foreach ($dataTaller->getResult() as $row) 
        {
            $data['nombreTaller'] = $row->nombreTaller;
            $data['telefono'] = $row->telefono;
            $data['direccion'] = $row->direccion;
            $data['emailT'] = $row->email;
        }
        $dataCliente = $clienteModel->SelectByIdPDF($idCliente);
        foreach ($dataCliente->getResult() as $row) 
        {
            $data['nombre'] = $row->nombre;
            $data['celular'] = $row->celular;
            $data['emailC'] = $row->email;
        }
        $html = view('cotizacion/clienteCotizacionPDF', $data);

        $dompdf = new Dompdf();


        $options = $dompdf->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('8.5x11', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Cotizacion.pdf', ['Attachment' => 0]);
        /**/

    }
}