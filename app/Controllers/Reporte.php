<?php

namespace App\Controllers;

use App\Models\TallerModel;

require_once $_SERVER["DOCUMENT_ROOT"].'/tu_taller/app/libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Reporte extends BaseController
{
    public function index()
    {
        echo view('master/header');
        echo view('paginaPrincipal');
        echo view('master/footer');
    }
    public function reportes()
    {
        $tipoReporte = $this->request->getPost('txtTipoReporte');
        $fechaInicio = $this->request->getPost('fechaInicio');
        $fechaFinal = $this->request->getPost('fechaFinal');
        $año = $this->request->getPost('txtAño');

      	$session = session();
        $idTaller = $session->get('id');

        $tallerModel = new TallerModel();
        $data['titulo'] = '';
        $data['dataReporte'] = '';
        $data['dataDetalleReporte'] = '';
        if ($tipoReporte == '1') 
        {
            $data['dataReporte'] = $tallerModel->SelectTipoServicioTallerCita($fechaInicio, $fechaFinal,$idTaller);
            $data['dataDetalleReporte'] = $tallerModel->SelectDetalleTipoServicioTallerCita($fechaInicio, $fechaFinal, $idTaller);
            $data['titulo'] = 'Cantidad de citas por tipo';
            $data['tipoReporte'] = $tipoReporte;
            $data['fechaInicio'] = $fechaInicio;
            $data['fechaFinal'] = $fechaFinal;
            $data['año'] = $año;

        }
        if ($tipoReporte == '2') 
        {
            $data['dataReporte'] = $tallerModel->SelectTipoServicioTallerCotizacion($fechaInicio, $fechaFinal,$idTaller);
            $data['dataDetalleReporte'] = $tallerModel->SelectDetalleTipoServicioTallerCotizacion($fechaInicio, $fechaFinal,$idTaller);
            $data['titulo'] = 'Cotizacion por tipo';
            $data['tipoReporte'] = $tipoReporte;
            $data['fechaInicio'] = $fechaInicio;
            $data['fechaFinal'] = $fechaFinal;
            $data['año'] = $año;
        }
        if ($tipoReporte == '3') 
        {
            $data['dataReporte'] = $tallerModel->SelectCalificacionTallerMes($año,$idTaller);
            $data['titulo'] = 'Calificacion por mes';
            $data['tipoReporte'] = $tipoReporte;
            $data['fechaInicio'] = $fechaInicio;
            $data['fechaFinal'] = $fechaFinal;
            $data['año'] = $año;
        }
        if ($tipoReporte == '4') 
        {
            $dataCitas = $tallerModel->SelectCitaTaller($fechaInicio, $fechaFinal,$idTaller);

            foreach ($dataCitas as $row) 
            {
                $temp[0][0] = "Total";
                $temp[0][1] = $row->total;
                $temp[1][0] = "Rechazados";
                $temp[1][1] = $row->rechazado;
                $temp[2][0] = "Pendientes";
                $temp[2][1] = $row->pendiente;
                $temp[3][0] = "Atender";
                $temp[3][1] = $row->atencion;
                $temp[4][0] = "Finalizados";
                $temp[4][1] = $row->finalizado;
                $temp[5][0] = "Inasistencia";
                $temp[5][1] = $row->inasistencia;
            }

            $data['dataReporte'] = $temp;
            $data['dataDetalleReporte'] = $tallerModel->SelectDetalleTipoServicioTallerCita($fechaInicio, $fechaFinal, $idTaller);
            $data['titulo'] = 'Citas totales';
            $data['tipoReporte'] = $tipoReporte;
            $data['fechaInicio'] = $fechaInicio;
            $data['fechaFinal'] = $fechaFinal;
            $data['año'] = $año;
        }
        
        echo view('master/header');
        echo view('reporte/reporteView',$data);
        echo view('master/footer');
    }
    public function reportePDF()
    {
        $tipoReporte = $this->request->getPost('txtTipoReporte');
        $fechaInicio = $this->request->getPost('fechaInicio');
        $fechaFinal = $this->request->getPost('fechaFinal');
        $año = $this->request->getPost('txtAño');

        $session = session();
        $idTaller = $session->get('id');

        $tallerModel = new TallerModel();
        $data['titulo'] = '';
        $data['dataReporte'] = '';
        $data['dataDetalleReporte'] = '';
        if ($tipoReporte == '1') 
        {
            $data['dataReporte'] = $tallerModel->SelectTipoServicioTallerCita($fechaInicio, $fechaFinal,$idTaller);
            $data['dataDetalleReporte'] = $tallerModel->SelectDetalleTipoServicioTallerCita($fechaInicio, $fechaFinal, $idTaller);
            $data['titulo'] = 'Cantidad de citas por tipo';
            $data['tipoReporte'] = $tipoReporte;
            $data['fechaInicio'] = $fechaInicio;
            $data['fechaFinal'] = $fechaFinal;
            $data['año'] = $año;
        }
        if ($tipoReporte == '2') 
        {
            $data['dataReporte'] = $tallerModel->SelectTipoServicioTallerCotizacion($fechaInicio, $fechaFinal,$idTaller);
            $data['dataDetalleReporte'] = $tallerModel->SelectDetalleTipoServicioTallerCotizacion($fechaInicio, $fechaFinal,$idTaller);
            $data['titulo'] = 'Cotizacion por tipo';
            $data['tipoReporte'] = $tipoReporte;
            $data['fechaInicio'] = $fechaInicio;
            $data['fechaFinal'] = $fechaFinal;
            $data['año'] = $año;
        }
        if ($tipoReporte == '3') 
        {
            $data['dataReporte'] = $tallerModel->SelectCalificacionTallerMes($año,$idTaller);
            $data['titulo'] = 'Calificacion por mes';
            $data['tipoReporte'] = $tipoReporte;
            $data['fechaInicio'] = $fechaInicio;
            $data['fechaFinal'] = $fechaFinal;
            $data['año'] = $año;
        }
        if ($tipoReporte == '4') 
        {
            $dataCitas = $tallerModel->SelectCitaTaller($fechaInicio, $fechaFinal,$idTaller);

            foreach ($dataCitas as $row) 
            {
                $temp[0][0] = "Total";
                $temp[0][1] = $row->total;
                $temp[1][0] = "Rechazados";
                $temp[1][1] = $row->rechazado;
                $temp[2][0] = "Pendientes";
                $temp[2][1] = $row->pendiente;
                $temp[3][0] = "Atender";
                $temp[3][1] = $row->atencion;
                $temp[4][0] = "Finalizados";
                $temp[4][1] = $row->finalizado;
                $temp[5][0] = "Inasistencia";
                $temp[5][1] = $row->inasistencia;
            }

            $data['dataReporte'] = $temp;
            $data['dataDetalleReporte'] = $tallerModel->SelectDetalleTipoServicioTallerCita($fechaInicio, $fechaFinal, $idTaller);
            $data['titulo'] = 'Citas totales';
            $data['tipoReporte'] = $tipoReporte;
            $data['fechaInicio'] = $fechaInicio;
            $data['fechaFinal'] = $fechaFinal;
            $data['año'] = $año;
        }

        //echo view('reporte/reportePDFView', $data);

        $html = view('reporte/reportePDFView', $data);

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
        $dompdf->stream('Reporte.pdf', ['Attachment' => 0]);
        /**/

    }
    public function fechaLiteral($mes)
    {
        $mesLiteral = '';
        switch ($mes) 
        {
            case '1':
                $mesLiteral = 'Enero';
                break;
            case '2':
                $mesLiteral = "Febrero";
                break;
            case '3':
                $mesLiteral = "Marzo";
                break;
            case '4':
                $mesLiteral = "Abril";
                break;
            case '5':
                $mesLiteral = "Mayo";
                break;
            case '6':
                $mesLiteral = "Junio";
                break;
            case '7':
                $mesLiteral = "Julio";
                break;
            case '8':
                $mesLiteral = "Agosto";
                break;
            case '9':
                $mesLiteral = "Septiembre";
                break;
            case '10':
                $mesLiteral = "Octubre";
                break;
            case '11':
                $mesLiteral = "Noviembre";
                break;
            default:
                $mesLiteral = "Diciembre";
                break;
        }
        return $mesLiteral;
    }
}
