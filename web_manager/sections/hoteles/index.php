<?php
$mod = $_GET['mod'];
if(empty($mod)) {
?>
<script>
    $(document).ready(function () {
        getHoteles();
        armarTableHabitaciones();

        $("#btnNuevoHotel").click(function () {
            window.location = 'panel.php?do=hoteles&mod=nuevo';
        });

        $("#btnNuevaHabitacion").click(function () {
            window.location = 'panel.php?do=hoteles&mod=nuevaHabitacion';
        });
    });

    function getHoteles() {
        var URL = 'sections/hoteles/hoteles.php?action=getHoteles&_t=' + new Date().getTime();
        $('#tabla-hoteles').bootstrapTable({
            url: URL,
            columns: [
                {
                    field: 'NOMBRE',
                    title: 'Nombre'
                },
                {
                    field: 'ACTIVO',
                    title: 'Estado',
                    align: 'center',
                    formatter: function (value) {
                        if(value == '1') {
                            return '<span style="color:green">Activo</span>';
                        }
                        if(value == '0') {
                            return '<span style="color:red">Inactivo</span>';
                        }
                    }
                },
                {
                    title: 'Editar',
                    align: 'center',
                    formatter: function () {
                        return btnModificar();
                    }
                },
                {
                    title: 'Eliminar',
                    align: 'center',
                    formatter: function () {
                        return btnEliminar();
                    }
                }
            ],
            onClickRow: function (row, $element, field) {
                if(field == 2) {
                    window.location = 'panel.php?do=hoteles&mod=editar&hID=' + row.ID;
                } else if(field == 3) {
                    var conf = confirm("¿Está seguro que desea eliminar el hotel " + row.NOMBRE + "?");
                    if(conf) {
                        var res = eliminarHotel(row.ID);
                        if(res == '1') {
                            alert('Hotel eliminado con éxito');
                            refreshTabla("tabla-hoteles");
                        } else {
                            alert('Error al eliminar.\n' + res);
                        }
                    }
                } else {
                    getHabitaciones(row.ID);
                }
            }
        });
    }

    function armarTableHabitaciones() {
        $('#tabla-habitaciones').bootstrapTable({
            columns: [
                {
                    field: 'NOMBRE',
                    title: 'Nombre'
                },
                {
                    field: 'CANTIDAD',
                    title: 'Cant.',
                    align: 'center'
                },
                {
                    field: 'DISPONIBLE',
                    title: 'Disponible',
                    align: 'center'
                },
                {
                    field: 'CAPACIDAD',
                    title: 'Capacidad',
                    align: 'center'
                },
                {
                    field: 'PRECIO',
                    title: 'Precio',
                    align: 'center',
                    formatter: function (value) {
                        return 'S/. ' + parseFloat(value).toFixed(2);
                    }
                },
                {
                    title: 'Editar',
                    align: 'center',
                    formatter: function () {
                        return btnModificar();
                    }
                },
                {
                    title: 'Eliminar',
                    align: 'center',
                    formatter: function () {
                        return btnEliminar();
                    }
                }
            ],
            onClickRow: function (row, $element, field) {
                var hID = $("#hdnHID").val();
                if(field == 5) {
                    window.location = 'panel.php?do=hoteles&mod=editarHabitacion&&hID=' + hID + '&habID=' + row.ID;
                } else if(field == 6) {
                    var conf = confirm("¿Está seguro que desea eliminar la habitación " + row.NOMBRE + "?");
                    if(conf) {
                        var res = eliminarHabitacion(row.ID);
                        if(res == '1') {
                            alert('Habitación eliminada con éxito');
                            getHabitaciones(hID); //refreshTabla("tabla-habitaciones");
                        } else {
                            alert('Error al eliminar.\n' + res);
                        }
                    }
                }
            }
        });
    }

    function getHabitaciones(hid) {
        var URL = 'sections/hoteles/hoteles.php?action=getHabitaciones&hID=' + hid + '&_t=' + new Date().getTime();
        $("#hdnHID").val(hid);
        $('#tabla-habitaciones').bootstrapTable('refresh', {url: URL});
    }

    function eliminarHotel(id) {
        var URL = 'sections/hoteles/hoteles.php?action=eliminar&hID=' + id + '&_t=' + new Date().getTime();
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

    function eliminarHabitacion(id) {
        var URL = 'sections/hoteles/hoteles.php?action=eliminarHabitacion&habID=' + id + '&_t=' + new Date().getTime();
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
<h1 class="page-title">Administrar Hoteles</h1>
<ol class="breadcrumb breadcrumb-2">
    <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
    <li class="active"><strong>Administrar Hoteles</strong></li>
</ol>
    <?php
    $status = $_GET['status'];
    $msg = $_GET['msg'];
    if($status == 'success') { ?>
        <div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Éxito!</strong> El hotel se grabó correctamente. </div>
    <?php } elseif($status == 'error') { ?>
        <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> Ocurrió un error al grabar el hotel. Por favor intente nuevamente.<br>Detalles del error: <?php echo $msg; ?></div>
    <?php } ?>
<div class="row">
    <div class="col-sm-5">
        <h3 class="pull-left">Hoteles</h3><button class="btn btn-primary btn-sm btn-add" id="btnNuevoHotel" style="margin-left: 15px;">Agregar Nuevo</button>
        <div class="table-responsive">
            <table id="tabla-hoteles" data-toggle="table" data-search="false" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" class="table table-users table-hover" data-locale="es-ES">
            </table>
        </div>
    </div>
    <div class="col-sm-7">
        <h3 class="pull-left">Habitaciones</h3><button class="btn btn-primary btn-sm btn-add" id="btnNuevaHabitacion" style="margin-left: 15px;">Agregar Nuevo</button>
        <div class="table-responsive">
            <table id="tabla-habitaciones" data-toggle="table" data-search="false" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" class="table table-users table-hover" data-locale="es-ES">
            </table>
        </div>
        <input type="hidden" name="hdnHID" id="hdnHID">
    </div>
</div>
<?php } elseif($mod == 'nuevo') {
?>
    <script>
        $(document).ready(function () {
            $("#btnCancelar").click(function () {
                window.location = 'panel.php?do=hoteles';
            });

            $("#btnGrabar").click(function () {
                var nombre = $("#txtNombre").val();
                var descripcion = $('#txtDescripcion').val();
                var estado = $("input[name='rdEstado']").groupVal();

                if(nombre == '') {
                    alert('Error: El NOMBRE no puede estar vacío.');
                    return;
                }

                grabarHotel(nombre, descripcion, estado);
            });
        });

        function grabarHotel(nombre, descripcion, estado) {
            var URL = 'sections/hoteles/hoteles.php?action=grabar&_t=' + new Date().getTime();
            var data = {
                p_nombre: nombre,
                p_descripcion: descripcion,
                p_estado: estado
            };

            $.ajax({
                async:false,
                method: "POST",
                url: URL,
                data: data,
                dataType: 'html',
                success: function(data) {
                    if(data == '1') {
                        window.location = 'panel.php?do=hoteles&status=success';
                    } else {
                        window.location = 'panel.php?do=hoteles&status=error&msg=' + data;
                    }
                }
            });
        }
    </script>
    <h1 class="page-title">Nuevo Hotel</h1>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="panel.php?do=hoteles">Administrar Hoteles</a></li>
        <li class="active"><strong>Nuevo Hotel</strong></li>
    </ol>
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <form>
                <div class="form-group">
                    <label for="txtNombre">Nombre</label>
                    <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="txtDescripcion">Contenido</label>
                    <textarea id="txtDescripcion" name="txtDescripcion" class="form-control" placeholder="Descripción"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Estado</label>
                    <div class="radio radio-replace radio-success">
                        <input type="radio" name="rdEstado" id="rdActivo" value="1" checked="checked">
                        <label for="rdActivo">Activo</label>
                    </div>
                    <div class="radio radio-replace radio-danger">
                        <input type="radio" name="rdEstado" id="rdInactivo" value="0">
                        <label for="rdInactivo">Inactivo</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h2 class="panel-title">Acciones</h2>
                </div>
                <div class="panel-body">
                    <button type="submit" class="btn btn-danger" id="btnCancelar"><span class="fa fa-close"></span> Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnGrabar"><span class="fa fa-check"></span> Guardar Hotel</button>
                </div>
            </div>
        </div>
    </div>
<?php } elseif($mod == 'editar') { ?>
    <script>
        $(document).ready(function () {
            var URL = 'sections/hoteles/hoteles.php?action=getHotel&hID=<?php echo $_GET['hID']; ?>&_t=' + new Date().getTime();
            $.ajax({
                async:false,
                url: URL,
                dataType: 'json',
                success: function(data) {
                    $("#txtNombre").val(data.NOMBRE);
                    $("#txtDescripcion").val(data.DESCRIPCION);
                    if(data.ACTIVO == '1') {
                        $("#rdActivo").prop("checked", true);
                    } else {
                        $("#rdInactivo").prop("checked", true);
                    }
                }
            });

            $("#btnCancelar").click(function () {
                window.location = 'panel.php?do=hoteles';
            });

            $("#btnGrabar").click(function () {
                var nombre = $("#txtNombre").val();
                var descripcion = $('#txtDescripcion').val();
                var estado = $("input[name='rdEstado']").groupVal();

                if(nombre == '') {
                    alert('Error: El NOMBRE no puede estar vacío.');
                    return;
                }

                actualizarHotel(nombre, descripcion, estado);
            });
        });

        function actualizarHotel(nombre, descripcion, estado) {
            var URL = 'sections/hoteles/hoteles.php?action=actualizar&hID=<?php echo $_GET['hID']; ?>&_t=' + new Date().getTime();
            var data = {
                p_nombre: nombre,
                p_descripcion: descripcion,
                p_estado: estado
            };

            $.ajax({
                async:false,
                method: "POST",
                url: URL,
                data: data,
                dataType: 'html',
                success: function(data) {
                    if(data == '1') {
                        window.location = 'panel.php?do=hoteles&status=success';
                    } else {
                        window.location = 'panel.php?do=hoteles&status=error&msg=' + data;
                    }
                }
            });
        }
    </script>
<h1 class="page-title">Editar Hotel</h1>
<ol class="breadcrumb breadcrumb-2">
    <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
    <li><a href="panel.php?do=hoteles">Administrar Hoteles</a></li>
    <li class="active"><strong>Editar Hotel</strong></li>
</ol>
<div class="row">
    <div class="col-sm-8 col-xs-12">
        <form>
            <div class="form-group">
                <label for="txtNombre">Nombre</label>
                <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre">
            </div>
            <div class="form-group">
                <label for="txtDescripcion">Contenido</label>
                <textarea id="txtDescripcion" name="txtDescripcion" class="form-control" placeholder="Descripción"></textarea>
            </div>
            <div class="form-group">
                <label for="">Estado</label>
                <div class="radio radio-replace radio-success">
                    <input type="radio" name="rdEstado" id="rdActivo" value="1" checked="checked">
                    <label for="rdActivo">Activo</label>
                </div>
                <div class="radio radio-replace radio-danger">
                    <input type="radio" name="rdEstado" id="rdInactivo" value="0">
                    <label for="rdInactivo">Inactivo</label>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h2 class="panel-title">Acciones</h2>
            </div>
            <div class="panel-body">
                <button type="submit" class="btn btn-danger" id="btnCancelar"><span class="fa fa-close"></span> Cancelar</button>
                <button type="submit" class="btn btn-success" id="btnGrabar"><span class="fa fa-check"></span> Actualizar Hotel</button>
            </div>
        </div>
    </div>
</div>
<?php } elseif($mod == 'nuevaHabitacion') { ?>
    <script>
        $(document).ready(function () {

            getHoteles();

            $("#btnCancelar").click(function () {
                window.location = 'panel.php?do=hoteles';
            });

            $("#btnGrabar").click(function () {
                var hid = $("#cboHotel").val();
                var nombre = $("#txtNombre").val();
                var cantidad = $('#txtCantidad').val();
                var capacidad = $('#txtCapacidad').val();
                var precio = $('#txtPrecio').val();

                if(nombre == '') {
                    alert('Error: El NOMBRE no puede estar vacío.');
                    return;
                } else if(cantidad == '') {
                    alert('Error: La CANTIDAD no puede estar vacía.');
                    return;
                } else if(capacidad == '') {
                    alert('Error: La CAPACIDAD no puede estar vacía.');
                    return;
                } else if(precio == '') {
                    alert('Error: El PRECIO no puede estar vacío.');
                    return;
                }

                grabarHabitacion(hid, nombre, cantidad, capacidad, precio);
            });
        });

        function getHoteles() {
            var URL = 'sections/hoteles/hoteles.php?action=getHoteles&_t=' + new Date().getTime();
            $.ajax({
                async:false,
                url: URL,
                dataType: 'json',
                success: function(data) {
                    $("#cboHotel").empty();
                    for(var i=0;i<data.length;i++) {
                        $("#cboHotel").append(new Option(data[i].NOMBRE, data[i].ID));
                    }
                }
            });
        }

        function grabarHabitacion(hid, nombre, cantidad, capacidad, precio) {
            var URL = 'sections/hoteles/hoteles.php?action=grabarHabitacion&_t=' + new Date().getTime();
            var data = {
                p_hid: hid,
                p_nombre: nombre,
                p_cantidad: cantidad,
                p_capacidad: capacidad,
                p_precio: precio
            };

            $.ajax({
                async:false,
                method: "POST",
                url: URL,
                data: data,
                dataType: 'html',
                success: function(data) {
                    if(data == '1') {
                        window.location = 'panel.php?do=hoteles&status=success';
                    } else {
                        window.location = 'panel.php?do=hoteles&status=error&msg=' + data;
                    }
                }
            });
        }
    </script>
    <h1 class="page-title">Nueva Habitación</h1>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="panel.php?do=hoteles">Administrar Hoteles</a></li>
        <li class="active"><strong>Nueva Habitación</strong></li>
    </ol>
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <form>
                <div class="form-group">
                    <label for="cboHotel">Hotel</label>
                    <select id="cboHotel" name="cboHotel" class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="txtNombre">Nombre</label>
                    <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="txtCantidad">Cantidad</label>
                    <input type="number" id="txtCantidad" name="txtCantidad" value="1" class="form-control" placeholder="Cantidad">
                </div>
                <div class="form-group">
                    <label for="txtCapacidad">Capacidad</label> <small>(Cantidad de personas como máximo por habitación)</small>
                    <input type="number" id="txtCapacidad" name="txtCapacidad" value="2" class="form-control" placeholder="Capacidad">
                </div>
                <div class="form-group">
                    <label for="txtPrecio">Precio</label>
                    <div class="input-group">
                        <span class="input-group-addon">S/.</span>
                        <input type="number" id="txtPrecio" name="txtPrecio" class="form-control" placeholder="Precio">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h2 class="panel-title">Acciones</h2>
                </div>
                <div class="panel-body">
                    <button type="submit" class="btn btn-danger" id="btnCancelar"><span class="fa fa-close"></span> Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnGrabar"><span class="fa fa-check"></span> Guardar Habitación</button>
                </div>
            </div>
        </div>
    </div>
<?php } elseif($mod == 'editarHabitacion') { ?>
    <script>
        $(document).ready(function () {
            getHoteles();

            var URL = 'sections/hoteles/hoteles.php?action=getHabitacion&hID=<?php echo $_GET['hID']; ?>&habID=<?php echo $_GET['habID']; ?>&_t=' + new Date().getTime();
            $.ajax({
                async:false,
                url: URL,
                dataType: 'json',
                success: function(data) {
                    $("#txtNombre").val(data.NOMBRE);
                    $("#txtCantidad").val(data.CANTIDAD);
                    $("#txtCapacidad").val(data.CAPACIDAD);
                    $("#txtPrecio").val(parseFloat(data.PRECIO).toFixed(2));
                    $("#cboHotel").val(data.HOTEL_ID);
                }
            });

            $("#btnCancelar").click(function () {
                window.location = 'panel.php?do=hoteles';
            });

            $("#btnGrabar").click(function () {
                var hid = $("#cboHotel").val();
                var nombre = $("#txtNombre").val();
                var cantidad = $('#txtCantidad').val();
                var capacidad = $('#txtCapacidad').val();
                var precio = $('#txtPrecio').val();

                if(nombre == '') {
                    alert('Error: El NOMBRE no puede estar vacío.');
                    return;
                } else if(cantidad == '') {
                    alert('Error: La CANTIDAD no puede estar vacía.');
                    return;
                } else if(capacidad == '') {
                    alert('Error: La CAPACIDAD no puede estar vacía.');
                    return;
                } else if(precio == '') {
                    alert('Error: El PRECIO no puede estar vacío.');
                    return;
                }

                actualizarHabitacion(hid, nombre, cantidad, capacidad, precio);
            });

        });
        function getHoteles() {
            var URL = 'sections/hoteles/hoteles.php?action=getHoteles&_t=' + new Date().getTime();
            $.ajax({
                async:false,
                url: URL,
                dataType: 'json',
                success: function(data) {
                    $("#cboHotel").empty();
                    for(var i=0;i<data.length;i++) {
                        $("#cboHotel").append(new Option(data[i].NOMBRE, data[i].ID));
                    }
                }
            });
        }

        function actualizarHabitacion(hid, nombre, cantidad, capacidad, precio) {
            var URL = 'sections/hoteles/hoteles.php?action=actualizarHabitacion&habID=<?php echo $_GET['habID']; ?>&_t=' + new Date().getTime();
            var data = {
                p_hid: hid,
                p_nombre: nombre,
                p_cantidad: cantidad,
                p_capacidad: capacidad,
                p_precio: precio
            };

            $.ajax({
                async:false,
                method: "POST",
                url: URL,
                data: data,
                dataType: 'html',
                success: function(data) {
                    if(data == '1') {
                        window.location = 'panel.php?do=hoteles&status=success';
                    } else {
                        window.location = 'panel.php?do=hoteles&status=error&msg=' + data;
                    }
                }
            });
        }
    </script>
    <h1 class="page-title">Editar Habitación</h1>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="panel.php?do=hoteles">Administrar Hoteles</a></li>
        <li class="active"><strong>Editar Habitación</strong></li>
    </ol>
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <form>
                <div class="form-group">
                    <label for="cboHotel">Hotel</label>
                    <select id="cboHotel" name="cboHotel" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtNombre">Nombre</label>
                    <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="txtCantidad">Cantidad</label>
                    <input type="number" id="txtCantidad" name="txtCantidad" value="1" class="form-control" placeholder="Cantidad">
                </div>
                <div class="form-group">
                    <label for="txtCapacidad">Capacidad</label> <small>(Cantidad de personas como máximo por habitación)</small>
                    <input type="number" id="txtCapacidad" name="txtCapacidad" value="2" class="form-control" placeholder="Capacidad">
                </div>
                <div class="form-group">
                    <label for="txtPrecio">Precio</label>
                    <div class="input-group">
                        <span class="input-group-addon">S/.</span>
                        <input type="number" id="txtPrecio" name="txtPrecio" class="form-control" placeholder="Precio">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h2 class="panel-title">Acciones</h2>
                </div>
                <div class="panel-body">
                    <button type="submit" class="btn btn-danger" id="btnCancelar"><span class="fa fa-close"></span> Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnGrabar"><span class="fa fa-check"></span> Guardar Habitación</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>