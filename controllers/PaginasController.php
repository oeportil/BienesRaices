<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{

    public static function index(Router $router)
    {

        $propiedades = Propiedad::get(3);
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => true

        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }
    public static function propiedades(Router $router)
    {

        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router)
    {

        $id = ValidateORedirect('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router)
    {
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router)
    {

        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router)
    {
        $mensaje = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST;
            //crear instancia de php mailer
            $mail = new PHPMailer(true);

            //configurar SMTP (protocolo que se utiliza para el envio de emails)
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '53b7d53340f0d9';
            $mail->Password = '671d518693ebda';
            $mail->SMTPSecure = 'tls';


            //Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('ernestoportilllo09@gmail.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //definir el contenido  
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre:' . $respuestas['nombre'] . '</p>';

            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió ser contactado por telefono:</p>';
                $contenido .= '<p>Telefono:' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha Contacto:' . $respuestas['contacto'] . '</p>';
                $contenido .= '<p>Hora:' . $respuestas['hora'] . '</p>';
            } else {
                $contenido .= '<p>Eligió ser contactado por email:</p>';
                $contenido .= '<p>Email:' . $respuestas['email'] . '</p>';
            }

            $contenido .= '<p>Mensaje:' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o compra:' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';

            $contenido .= '</html>';
            debuguear($contenido);
            $mail->Body = $contenido;
            $mail->AltBody = 'Texto alternativo sin html    ';

            //enviar el email
            if ($mail->send()) {
                $mensaje =  "mensaje enviado";
            } else {
                $mensaje =  "mensaje sin enviar";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
