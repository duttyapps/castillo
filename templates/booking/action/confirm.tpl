<div class="container wrap">
    <div class="page-header">
        <h2>Reservar Hotel</h2>
    </div>
    <div class="row">
        <div class="booking-breadcrumb clearfix">
            <ul class="clearfix">
                <li>
                    <span class="badge">1</span> Datos de Reserva
                </li>
                <li>
                    <span class="badge active">2</span> Confirmar Reserva
                </li>
                <li>
                    <span class="badge">3</span> ¡Reserva Hecha!
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table-booking-details">
                <tr>
                    <td><b>Empresa:</b></td>
                    <td>{$empresa|default:'-'}</td>
                </tr>
                <tr>
                    <td><b>Nombres y Apellidos:</b></td>
                    <td>{$nombres} {$apellidos}</td>
                </tr>
                <tr>
                    <td><b>Email:</b></td>
                    <td>{$email|default:'-'}</td>
                </tr>
                <tr>
                    <td><b>Teléfono:</b></td>
                    <td>{$telefono|default:'-'}</td>
                </tr>
                <tr>
                    <td><b>Dirección:</b></td>
                    <td>{$direccion}</td>
                </tr>
                <tr>
                    <td><b>Ciudad - País:</b></td>
                    <td>{$ciudad} - {$pais}</td>
                </tr>
                <tr>
                    <td><b>Detalle Adicional:</b></td>
                    <td>{$detalle|default:'-'}</td>
                </tr>
            </table>
            <hr>
            <table width="100%" class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        # Reserva
                    </th>
                    <th>
                        Hotel
                    </th>
                    <th>
                        Habitación
                    </th>
                    <th>
                        Check In
                    </th>
                    <th>
                        Check Out
                    </th>
                    <th>
                        Cant. Adultos
                    </th>
                    <th>
                        Cant. Menores
                    </th>
                    <th>
                        Cant. Habitaciones
                    </th>
                    <th>
                        Precio por Día
                    </th>
                    <th>
                        Días
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        {$nro_reserva}
                    </td>
                    <td>
                        {$hotel_des}
                    </td>
                    <td>
                        {$habitacion_des}
                    </td>
                    <td>
                        {$checkin}
                    </td>
                    <td>
                        {$checkout}
                    </td>
                    <td>
                        {$adultos}
                    </td>
                    <td>
                        {$menores}
                    </td>
                    <td>
                        {$habitaciones}
                    </td>
                    <td>
                        S/. {$total_habitacion}
                    </td>
                    <td>
                        {$dias}
                    </td>
                </tr>
                <tr>
                    <td colspan="10" align="right">
                        <span class="booking-total-price">Pago Total: S/. {$total_reserva}</span>
                    </td>
                </tr>
                </tbody>
            </table>
            <form action="{$path}/index.php/booking/action/done" method="post">
                <div class="col-lg-12 form-group text-center">
                    <button type="submit" class="btn btn-warning">Modificar Reserva</button>
                    <button type="submit" class="btn btn-danger">Cancelar Reserva</button>
                    <button type="submit" class="btn btn-success">Realizar Reserva</button>
                </div>
            </form>
        </div>
    </div>
</div>