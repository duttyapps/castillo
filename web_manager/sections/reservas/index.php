<?php

?>
<script>
    $(document).ready(function () {
        var URL = 'sections/reservas/reservas.php?action=getReservas&_t=' + new Date().getTime();

        $('#tabla-reservas').bootstrapTable({
            url: URL,
            columns: [
                {
                    field: 'NRO_RESERVA',
                    title: 'Nro. Reserva'
                },
                {
                    field: 'APELLIDOS',
                    title: 'Apellidos'
                },
                {
                    field: 'NOMBRES',
                    title: 'Nombres'
                },
                {
                    field: 'FECHA_RESERVA',
                    title: 'Fecha de Reserva'
                },
                {
                    field: 'TOTAL',
                    title: 'Total',
                    formatter: function (value) {
                        return 'S/. ' + value;
                    }
                },
                {
                    field: 'ESTADO',
                    title: 'Estado',
                    formatter: function (value, row, index) {
                        if(value == 'P') {
                            return 'Pendiente';
                        }
                        if(value == 'C') {
                            return 'Confirmado';
                        }
                    }
                },
                {
                    title: 'Detalle',
                    align: 'center',
                    formatter: function() {
                        return btnDetalle();
                    }
                }
            ]
        });
    });

    function hotelDes(id) {
        var URL = 'sections/reservas/reservas.php?action=getHotelDesc&hID=' + id + '&_t=' + new Date().getTime();
        var result;

        $.ajax({
            async:false,
            url: URL,
            dataType: 'html',
            success: function(data) {
                result = data;
            }
        });

        return result;
    }

    function habitacionDes(hid, habid) {
        var URL = 'sections/reservas/reservas.php?action=getHabitacionDesc&hID=' + hid + '&habID=' + habid + '&_t=' + new Date().getTime();
        var result;

        $.ajax({
            async:false,
            url: URL,
            dataType: 'html',
            success: function(data) {
                result = data;
            }
        });

        return result;
    }
</script>

<h1 class="page-title">Reserva de Hoteles</h1>
<div class="table-responsive">
    <table id="tabla-reservas" data-toggle="table" data-search="true" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" class="table table-users table-hover" data-locale="es-ES">
    </table>
</div>