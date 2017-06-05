<?php
$Template->assign('title', 'Contáctanos | ');

$action = $Request->getParamater('contact');

if ($action == 'send') {
    if(count($_POST) > 0) {
        $nombres = $_POST['txtNombres'] . ' ' . $_POST['txtApellidos'];
        $email = $_POST['txtEmail'];
        $telefono = $_POST['txtTelefono'];
        $pais = $_POST['cboPais'];
        $ciudad = $_POST['txtCiudad'];
        $mensaje = $_POST['txtMensaje'];

        if(empty($nombres) || empty($email) || empty($telefono) || empty($pais) || empty($ciudad) || empty($mensaje)) {
            $Template->assign('error', 'Todos los campos son obligatorios.');
        } else {
            $to = 'carlosarcesh@gmail.com';

            $subject = 'Formulario de Contacto - Castillo de Chancay';

            $headers = "From: Castillo de Chancay<no-reply@castillodechancay.com>\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $Template->assign('url_logo', "http://{$_SERVER['SERVER_NAME']}/images/logow.png");
            $Template->assign('nombres', $nombres);
            $Template->assign('email', $email);
            $Template->assign('telefono', $telefono);
            $Template->assign('pais', $pais);
            $Template->assign('ciudad', $ciudad);
            $Template->assign('mensaje', htmlentities($mensaje));

            $msg = $Template->fetch('emails/contact.tpl');

            if($_COOKIE['mailed'] == true) {
                $Template->assign('error', 'Solo puede enviar un mensaje cada 5 minutos.');
            } else {
                mail($to, $subject, $msg, $headers);
                setcookie("mailed", true, time() + (60 * 5));
                $Template->assign('success', true);
            }
        }
    } else {
        header('location: ' . \Classes\Utils::getContextPath() . '/contact');
    }
}