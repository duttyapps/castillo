<?php
use \Classes\RemoteAddress as cRemoteAddress;

session_start();

function getDescHotel($id) {
    $db = MysqliDb::getInstance();
    $db->where('ID', $id);
    return $db->getValue('hoteles', 'NOMBRE');
}

function getDescHabitacion($hid, $id) {
    $db = MysqliDb::getInstance();
    $db->where('ID', $id);
    $db->where('HOTEL_ID', $hid);
    return $db->getValue('hotel_habitaciones', 'NOMBRE');
}

function getTotal($id) {
    $db = MysqliDb::getInstance();
    $db->where('ID', $id);
    return number_format($db->getValue('reserva_hotel', 'TOTAL'), 2);
}

if(count($_POST) > 0) {
    $hotel = $_POST['cboHotel'];
    $habitacion = $_POST['cboHabitacion'];
    $checkin = $_POST['txtCheckIn'];
    $checkout = $_POST['txtCheckOut'];
    $habitaciones = $_POST['cboHabitaciones'];
    $adultos = $_POST['cboAdultos'];
    $menores = $_POST['cboMenores'];
    $tratamiento = $_POST['cboTratamiento'];
    $nombres = $_POST['txtNombres'];
    $apellidos = $_POST['txtApellidos'];
    $email = $_POST['txtEmail'];
    $telefono = $_POST['txtTelefono'];
    $pais = $_POST['cboPais'];
    $ciudad = $_POST['txtCiudad'];
    $direccion = $_POST['txtDireccion'];
    $empresa = $_POST['txtEmpresa'];
    $detalle = $_POST['txtDetalle'];
}

$action = $Request->getParamater('action');

if($action == 'confirm') {
    \Classes\Utils::save_log('Acción confirmar reserva.');

    $rIP = new cRemoteAddress();
    $remote_ip = $rIP->getIpAddress();

    $db->where('ID', 1);
    $db->where('HOTEL_ID', 1);
    $precio_habitacion = $db->getValue('hotel_habitaciones', 'PRECIO');

    $fecha_ini = DateTime::createFromFormat('d/m/Y', $checkin);
    $fecha_fin = DateTime::createFromFormat('d/m/Y', $checkout);

    $total_dias = number_format($fecha_fin->diff($fecha_ini)->format("%a"), 0);

    if($total_dias == 0) {
        $total_dias = 1;
    }

    $total = floor($precio_habitacion * $habitaciones * $total_dias);

    $data = array(
        'ID_HOTEL' => $hotel,
        'ID_HABITACION' => $habitacion,
        'FECHA_RESERVA' => $db->now(),
        'CHECK_IN' => $checkin,
        'CHECK_OUT' => $checkout,
        'HABITACIONES' => $habitaciones,
        'ADULTOS' => $adultos,
        'MENORES' => $menores,
        'TRATAMIENTO' => $tratamiento,
        'NOMBRES' => $nombres,
        'APELLIDOS' => $apellidos,
        'EMAIL' => $email,
        'TELEFONO' => $telefono,
        'PAIS' => $pais,
        'CIUDAD' => $ciudad,
        'DIRECCION' => $direccion,
        'EMPRESA' => $empresa,
        'DETALLE' => $detalle,
        'TOTAL' => $total,
        'ESTADO' => 'P',
        'IP' => $remote_ip
    );

    $data_log = "'
         ID_HOTEL' => $hotel,
        'ID_HABITACION' => $habitacion,
        'FECHA_RESERVA' => $db->now(),
        'CHECK_IN' => $checkin,
        'CHECK_OUT' => $checkout,
        'HABITACIONES' => $habitaciones,
        'ADULTOS' => $adultos,
        'MENORES' => $menores,
        'TRATAMIENTO' => $tratamiento,
        'NOMBRES' => $nombres,
        'APELLIDOS' => $apellidos,
        'EMAIL' => $email,
        'TELEFONO' => $telefono,
        'PAIS' => $pais,
        'CIUDAD' => $ciudad,
        'DIRECCION' => $direccion,
        'EMPRESA' => $empresa,
        'DETALLE' => $detalle,
        'TOTAL' => $total,
        'ESTADO' => 'P',
        'IP' => $remote_ip";

    \Classes\Utils::save_log('Datos enviados: ' . $data_log);

    $_SESSION['id_reserva'] = $db->insert ('reserva_hotel', $data);
    $id_reserva = $_SESSION['id_reserva'];

    if ($db->getLastErrno() === 0) {
        \Classes\Utils::save_log('Reserva grabada con éxito ' . $id_reserva);
    } else {
        \Classes\Utils::showError('Ocurrió un error al realizar la reserva. Por favor, intente más tarde.');
        \Classes\Utils::save_log('Error al insertar reserva ' . $db->getLastError(), 1);
    }

    $cod_hotel = str_pad($hotel, 2, "0", STR_PAD_LEFT);
    $cod_habitacion = str_pad($habitacion, 2, "0", STR_PAD_LEFT);
    $nro_reserva = 'RV-' . $cod_hotel . $cod_habitacion . str_pad($id_reserva, 6, "0", STR_PAD_LEFT);
    $_SESSION['nro_reserva'] = $nro_reserva;

    $upd_data = array(
        'NRO_RESERVA' => $nro_reserva
    );

    $db->where('ID', $id_reserva);
    if($db->update('reserva_hotel', $upd_data)) {
        \Classes\Utils::save_log('Reserva actualizada con éxito ' . $nro_reserva);
    } else {
        \Classes\Utils::showError('Ocurrió un error al actualizar la reserva. Por favor, intente más tarde.');
        \Classes\Utils::save_log('Error al actualizar reserva ' . $db->getLastError(), 1);
    }
}

$db->where('ACTIVO', 1);
$db->orderBy('NOMBRE', 'ASC');
$hoteles = $db->get("hoteles");

$hotel_des = getDescHotel($hotel);
$habitacion_des = getDescHabitacion($hotel, $habitacion);
$total_reserva = getTotal($id_reserva);

$Template->assign("action", $action);
$Template->assign("nro_reserva", $_SESSION['nro_reserva']);
$Template->assign("hotel", $hotel);
$Template->assign("hotel_des", $hotel_des);
$Template->assign("habitacion", $habitacion);
$Template->assign("habitacion_des", $habitacion_des);
$Template->assign("hoteles", $hoteles);
$Template->assign("checkin", $checkin);
$Template->assign("checkout", $checkout);
$Template->assign("habitaciones", $habitaciones);
$Template->assign("adultos", $adultos);
$Template->assign("menores", $menores);
$Template->assign("total_habitacion", number_format($precio_habitacion, 2));
$Template->assign("total_reserva", $total_reserva);
$Template->assign("dias", $total_dias);
$Template->assign("nombres", $nombres);
$Template->assign("apellidos", $apellidos);
$Template->assign("tratamiento", $tratamiento);
$Template->assign("email", $email);
$Template->assign("telefono", $telefono);
$Template->assign("pais", $pais);
$Template->assign("ciudad", $ciudad);
$Template->assign("direccion", $direccion);
$Template->assign("empresa", $empresa);
$Template->assign("detalle", $detalle);