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
                /*if (mail('tanjhosan58@gmail.com', 'sub', 'mensaje', 'autotestproy@gmail.com'))
                    echo "si";
                else
                    echo "no";*/
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
        /*
        if ($contraseña==$repetirContraseña) 
        {
            //verificacion de email
            if (!$usuarioModel->EmailExists($email)) 
            {
                if ($respuesta > 0)
                {
                    $mail = \Config\Services::email();
                    $mail->setFrom('jhmartinez.dev@items.bo');
                    $mail->setTo($email);
                    $mail->setSubject('Activación de correo');
                    $mail->setMessage("
                    <div style='background-color:#e1e8ed;padding:20px'>
 <div style='background-color:#ffffff;Margin:0px auto;max-width:825px'>
    <table align='center' style='background:#ffffff;background-color:#ffffff; width:100%'>
    <tbody>
     <tr>
     <td style='height: 15.0pt; width: 20pt;' width='20' height='20'>
     </td>
     <td>
 <div align='center'>
     <img class='lazy' src='https://itc.academia.bo/ITCAcademia/sources/images/logoNegativo.png' alt='' width='250' height='200' />
</div>
 </td>
  <td style='height: 15.0pt; width: 20pt;' width='20' height='20'></td>
  </tr>
  <tr>
      <td style='height: 15.0pt; width: 20pt;' width='20' height='20'>
  </td>
  <td style='text-align: center;'>
       <span style='font-size: 15pt;'> <b>VERIFICACIÓN DE CUENTA</b> </span>
     </td>
     <td style='width: 20pt;' width='20'>
     </td> </tr>
  </tbody>
 </table>
<table align='center' style='background:#ffffff;background-color:#ffffff;width:100%'>
 <tbody>
     <tr>
     <td style='padding:10px 25px;word-break:break-word'>
 <div style='font-size:12px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%'>
   <span style='font-size: 13pt;'> Hola Sr/Sra <b>".$nombres.' '.$primerApellido.' '.$segundoApellido."</b>! </span>
   <span style='font-size: 12pt;'> Gracias por registrarse en nuestra página web, debe verificar su correo electrónico para poder iniciar sesión.</span><br>
   <span style='font-size: 12pt;'> 
   Puede hacerlo en el siguiente boton:</span>
   </div>
  </td>
  </tr>
  </tbody>
  </table>
<table align='center' style='background:#ffffff;background-color:#ffffff;width:100%'>
    <tbody>
    <tr>
     <td style='padding:0px 90px;word-break:break-word'>
     <div style='text-align:center;direction:ltr;display:inline-block;vertical-align:top;width:100%'>
         <br>
         <a href='http://localhost/ITCAcademia/public/usuario/activation/".$key."'><button style='background: #1DA338; width: 200px; height: 100px; color: #fff; font-size: 14pt;'>ACTIVAR CUENTA</button></a>
     </div>
        </td>
        </tr>
  </tbody>
 </table>
 <table align='center' style='background:#ffffff;background-color:#ffffff;width:100%'>
 <tbody>
      <tr> <td style='padding:10px 25px;word-break:break-word'>
         <div style='font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%'>
             <span style='font-size: 11pt;'> NOTA: Si el botón no funciona utilice el siguiente enlace: <a href='https://itc.academia.bo/ITCAcademia/public/usuario/activation/".$key."'>Activar cuenta</a> </span>
        </div>
    </td> </tr>
 </tbody>
</table>
 <br><br>
<div class='lg-50 lg-to-center'><div class='signature-container s-radius-1 s-mb-4'>
        <table class='signature' id='signature' style='table-layout: auto; margin-bottom: 0px; font-family: arial; border-collapse: initial; width: max-content; min-width: auto; height: 170px; padding: 10px 16px; border: 1px solid rgb(0, 0, 128); border-radius: 4px;'>
            <tbody><tr style='border: none;'>
                <td class='avatar ' style='padding: 0px; background: #0c3952; margin-right: 8px;'><a href='https://itc.academia.bo/' class='custom-logo-link' rel='home' aria-current='page'><img width='185' height='185' src='https://itc.academia.bo/wp-content/uploads/2022/07/MARCA-VERTICAL-POSITIVO.png' class='custom-logo' alt='ITC ACADEMIA'></a>
          </td>
                <td class='information' style='text-align: left; background: none; padding: 0px 14px 0px 8px; min-width: 175px;'><b style='margin-bottom: 4px; font-size: 20px; color: rgb(42, 59, 71); line-height: 24px; height: 24px;'>Alejandra Alegre Inocente</b><p style='font-size: 14px; margin: 0px 0px 8px;'><span style='color: rgb(105, 116, 119); margin: 0px;'>ASESORA ACADÉMICA</span></p>
                    <div id='sociales'></div>
                    <a href='https://facebook.com/itc.com.bo' target='_blank' rel='noopener noreferrer nofollow' style='margin-right: 15px; display: inline-block;'><img src='https://i.ibb.co/dMWSRnj/facebook.png' alt='facebook' border='0'></a>
                    <a href='https://wa.me/+59168526477' target='_blank' rel='noopener noreferrer nofollow' style='margin-right: 15px; display: inline-block;'><img src='https://i.ibb.co/yQKTXm9/whatsapp.png' alt='whatsapp' border='0'></a></td>
                <td style='padding: 0px; min-width: auto;'><div class='color-signature' style='width: 4px; height: 150px; box-sizing: border-box; border-radius: 50px; background-color: rgb(17, 146, 238); border: 2px solid rgb(12, 57, 82);'></div></td>
                <td style='background: none; padding: 10px 0px 7px 14px;'>
                    <span class='s-whitespace-nowrap s-text-ellipsis mw-signature' style='margin-bottom: 4px; font-size: 14px; color: rgb(105, 116, 119); line-height: 24px; height: 24px; display: block; text-align: left;'><img src='https://i.ibb.co/t3C1pDg/phone-blue.png' alt='' width='20' height='20' style='margin-top: 3px; float: left; margin-right: 7px; border-radius: 50%; display: block;'>68526477</span>
                    
                    <span class='s-whitespace-nowrap s-text-ellipsis mw-signature' style='margin-bottom: 4px; font-size: 14px; color: rgb(105, 116, 119); line-height: 24px; height: 24px; display: block; text-align: left;'><img src='https://i.ibb.co/n19DbLr/pin-blue.png' alt='' width='20' height='20' style='margin-top: 3px; float: left; margin-right: 7px; border-radius: 50%; display: block;'>Av. América Este y Plaza del Arquitecto N°03, <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;una cuadra al sud (lado Radio Patrulla 110)</span>
            
                    <br><a href='https://itc.academia.bo'><span class='s-whitespace-nowrap s-text-ellipsis mw-signature' style='margin-bottom: 4px; font-size: 14px; color: rgb(105, 116, 119); line-height: 24px; height: 24px; display: block; text-align: left;'><img src='https://i.ibb.co/BCKrmjf/url-blue.png' alt='' width='20' height='20' style='margin-top: 3px; float: left; margin-right: 7px; border-radius: 50%; display: block;'>itc.academia.bo</span></a><a>
    
</a></td></tr></tbody></table></div></div>
 </div>
</div>");
                    $mail->send();
                    $url = base_url('public/usuario/registrarUsuario');
                    return redirect()->to($url)->with('messageReport','1');
                }
            }
            else
            {
               $url = base_url('public/usuario/registrarUsuario');
                return redirect()->to($url)->with('messageReport','3'); 
            }

        }
        else
        {
            $url = base_url('public/usuario/registrarUsuario');
            return redirect()->to($url)->with('messageReport','2');
        }*/
    }
}