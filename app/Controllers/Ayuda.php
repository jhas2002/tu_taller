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

    
    
    
}