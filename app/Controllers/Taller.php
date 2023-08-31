<?php

namespace App\Controllers;

use App\Models\UsuarioModel;


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

        $data['messageReport']= $messageReport;

    	echo view('master/header');
        echo view('taller/registroView', $data);
        echo view('master/footer');
    }
}