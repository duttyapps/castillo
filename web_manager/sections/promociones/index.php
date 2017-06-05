<?php
if(empty($mod)) {
    ?>
    <script>
        $(document).ready(function () {
            getPromociones();

            $("#btnCambiarEstado").click(function () {
                var id = $("#hdnID").val();
                if (id.length > 0) {
                    var estado = $("input[name='rdEstado']").groupVal();
                    var res = cambiarEstado(id, estado);
                    if (res == '1') {
                        alert('Estado actualizado con éxito.');
                    } else {
                        alert('Error al actualizar: ' + res);
                    }
                    refreshTabla("tabla-promociones");
                } else {
                    return;
                }
            });

            $("#btnNuevaPromocion").click(function () {
                window.location = 'panel.php?do=promociones&mod=nuevo';
            });
        });

        function getPromociones() {
            var URL = 'sections/promociones/promociones.php?action=getPromociones&_t=' + new Date().getTime();
            $('#tabla-promociones').bootstrapTable({
                url: URL,
                columns: [
                    {
                        field: 'ID',
                        title: 'Imágen',
                        align: 'center',
                        formatter: function (value) {
                            return '<img src="../images/promociones/' + value + '.jpg" width="24" height="24">';
                        }
                    },
                    {
                        field: 'NOMBRE',
                        title: 'Promoción',
                        sortable: true
                    },
                    {
                        field: 'FECHA_INI',
                        title: 'Fecha Inicio',
                        sortable: true
                    },
                    {
                        field: 'FECHA_FIN',
                        title: 'Fecha Fin',
                        sortable: true
                    },
                    {
                        field: 'ACTIVO',
                        title: 'Estado',
                        align: 'center',
                        formatter: function (value) {
                            if (value == '1') {
                                return '<span style="color:green">Activo</span>';
                            }
                            if (value == '0') {
                                return '<span style="color:red">Inactivo</span>';
                            }
                        },
                        sortable: true
                    },
                    {
                        field: 'VENCIDO',
                        title: '¿Vencido?',
                        align: 'center',
                        formatter: function (value) {
                            if (value == '1') {
                                return '<span style="color:green">NO</span>';
                            }
                            if (value == '0') {
                                return '<span style="color:red">SI</span>';
                            }
                        },
                        sortable: true
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
                    if (field == 6) {
                        window.location = 'panel.php?do=promociones&mod=editar&pID=' + row.ID;
                    } else if (field == 7) {
                        var conf = confirm("¿Está seguro que desea eliminar la promoción " + row.NOMBRE + "?");
                        if (conf) {
                            var res = eliminarPromocion(row.ID);
                            if (res == '1') {
                                alert('Promoción eliminada con éxito');
                                refreshTabla("tabla-promociones");
                            } else {
                                alert('Error al eliminar.\n' + res);
                            }
                        }
                    } else {
                        cargaCambioEstado(row);
                    }
                }
            });
        }

        function cargaCambioEstado(data) {
            $("#pagina-titulo").html(data.NOMBRE);
            $("#hdnID").val(data.ID);
            if (data.ACTIVO == '1') {
                $("#rdActivo").prop("checked", true);
            } else {
                $("#rdInactivo").prop("checked", true);
            }
        }

        function cambiarEstado(id, estado) {
            var URL = 'sections/promociones/promociones.php?action=actualizarEstado&pID=' + id + '&est=' + estado + '&_t=' + new Date().getTime();
            var result;

            $.ajax({
                async: false,
                url: URL,
                dataType: 'html',
                success: function (data) {
                    result = data;
                }
            });

            return result;
        }

        function eliminarPromocion(id) {
            var URL = 'sections/promociones/promociones.php?action=eliminar&pID=' + id + '&_t=' + new Date().getTime();
            var result;

            $.ajax({
                async: false,
                url: URL,
                dataType: 'html',
                success: function (data) {
                    result = data;
                }
            });

            return result;
        }
    </script>
    <div class="page-heading clearfix">
        <h1 class="page-title pull-left">Administrar Promociones</h1>
        <button class="btn btn-primary btn-sm btn-add" id="btnNuevaPromocion">Agregar Nuevo</button>
    </div>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><strong>Administrar Promociones</strong></li>
    </ol>
    <?php
    $status = $_GET['status'];
    $msg = $_GET['msg'];
    if($status == 'success') { ?>
        <div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Éxito!</strong> La página se grabó correctamente. </div>
    <?php } elseif($status == 'error') { ?>
        <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> Ocurrió un error al grabar la página. Por favor intente nuevamente.<br>Detalles del error: <?php echo $msg; ?></div>
    <?php } ?>
    <div class="row">
        <div class="col-sm-8 col-xs-6">
            <div class="table-responsive">
                <table id="tabla-promociones" data-toggle="table" data-search="true" data-show-refresh="true"
                       data-show-toggle="true" data-show-columns="true" class="table table-users table-hover"
                       data-locale="es-ES">
                </table>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h2 class="panel-title">Modificar Estado</h2>
                </div>
                <div class="panel-body">
                    <h4 id="pagina-titulo">-</h4>
                    Estado:
                    <div class="radio radio-replace radio-success">
                        <input type="radio" name="rdEstado" id="rdActivo" value="1" checked="checked">
                        <label for="rdActivo">Activo</label>
                    </div>
                    <div class="radio radio-replace radio-danger">
                        <input type="radio" name="rdEstado" id="rdInactivo" value="0">
                        <label for="rdInactivo">Inactivo</label>
                    </div>
                    <div class="line-dashed"></div>
                    <input type="hidden" name="hdnID" id="hdnID">
                    <button type="submit" class="btn btn-primary" id="btnCambiarEstado">Cambiar Estado</button>
                </div>
            </div>
        </div>
    </div>
    <?php
} elseif($mod == 'nuevo') {
    ?>
    <script>
        $(document).ready(function () {
            $("#txtNombre").change(function () {
                $("#txtEnlace").val($("#txtNombre").val().cleanup());
            });

            $("#btnCancelar").click(function () {
                window.location = 'panel.php?do=promociones';
            });

            $("#btnGrabar").click(function (e) {
                e.preventDefault();

                var nombre = $("#txtNombre").val();
                var fecha_ini = $('#txtFechaIni').val();
                var fecha_fin = $("#txtFechaFin").val();
                var enlace = $("#txtEnlace").val();
                var estado = $("input[name='rdEstado']").groupVal();

                if(nombre == '') {
                    alert('Error: El NOMBRE no puede estar vacío.');
                    return;
                } else if(fecha_ini == '') {
                    alert('Error: La FECHA DE INICIO no puede estar vacío.');
                    return;
                } else if(fecha_fin == '') {
                    alert('Error: La FECHA DE FIN no puede estar vacío.');
                    return;
                } else if(enlace == '') {
                    alert('Error: El ENLACE no puede estar vacío.');
                    return;
                }

                $("#frmNuevaPromocion").submit();

            });
        });
    </script>
    <h1 class="page-title">Nueva Promoción</h1>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="panel.php?do=promociones">Administrar Promociones</a></li>
        <li class="active"><strong>Nueva Promoción</strong></li>
    </ol>
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <form id="frmNuevaPromocion" action="sections/promociones/promociones.php?action=grabar" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtNombre">Nombre de la Promoción</label>
                    <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="txtFechaIni">Fecha de Inicio</label>
                    <div class="input-group date col-lg-3">
                        <input id="txtFechaIni" name="txtFechaIni" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control" data-provide="datepicker">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtFechaFin">Fecha de Fin</label>
                    <div class="input-group date col-lg-3">
                        <input id="txtFechaFin" name="txtFechaFin" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control" data-provide="datepicker">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtEnlace">Enlace</label>
                    <div class="input-group">
                        <span class="input-group-addon">/</span>
                        <input type="text" class="form-control" id="txtEnlace" name="txtEnlace" placeholder="Enlace">
                    </div>
                </div>
                <div class="form-group">
                    <label for="file">Imágen</label> <small>(480x550px | Formato JPG)</small>
                    <input type="file" class="form-control" id="file" name="file" placeholder="Imágen">
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
                    <button type="submit" class="btn btn-success" id="btnGrabar"><span class="fa fa-check"></span> Guardar Promoción</button>
                </div>
            </div>
        </div>
    </div>
    <?php
} elseif($mod == 'editar') {
    ?>
    <script>
        $(document).ready(function () {
            var URL = 'sections/promociones/promociones.php?action=getPromocion&pID=<?php echo $_GET['pID']; ?>&_t=' + new Date().getTime();
            $.ajax({
                async:false,
                url: URL,
                dataType: 'json',
                success: function(data) {
                    $("#txtNombre").val(data.NOMBRE);
                    $("#txtFechaIni").val(data.FECHA_INI);
                    $("#txtFechaFin").val(data.FECHA_FIN);
                    $("#txtEnlace").val(data.LINK);
                    if(data.ACTIVO == '1') {
                        $("#rdActivo").prop("checked", true);
                    } else {
                        $("#rdInactivo").prop("checked", true);
                    }
                }
            });

            $("#btnCancelar").click(function () {
                window.location = 'panel.php?do=promociones';
            });

            $("#btnGrabar").click(function () {
                var nombre = $("#txtNombre").val();
                var fecha_ini = $('#txtFechaIni').val();
                var fecha_fin = $('#txtFechaFin').val();
                var enlace = $("#txtEnlace").val();
                var estado = $("input[name='rdEstado']").groupVal();

                if(nombre == '') {
                    alert('Error: El NOMBRE no puede estar vacío.');
                    return;
                } else if(fecha_ini == '') {
                    alert('Error: La FECHA DE INICIO no puede estar vacío.');
                    return;
                } else if(fecha_fin == '') {
                    alert('Error: La FECHA DE FIN no puede estar vacío.');
                    return;
                } else if(enlace == '') {
                    alert('Error: El ENLACE no puede estar vacío.');
                    return;
                }

                $("#frmEditarPromocion").submit();

            });
        });
    </script>
    <h1 class="page-title">Editar Promoción</h1>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="panel.php?do=promociones">Administrar Promociones</a></li>
        <li class="active"><strong>Editar Promoción</strong></li>
    </ol>
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <form id="frmEditarPromocion" action="sections/promociones/promociones.php?action=actualizar&pID=<?php echo $_GET['pID']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtNombre">Nombre de la Promoción</label>
                    <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="txtFechaIni">Fecha de Inicio</label>
                    <div class="input-group date col-lg-3">
                        <input id="txtFechaIni" name="txtFechaIni" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control" data-provide="datepicker">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtFechaFin">Fecha de Fin</label>
                    <div class="input-group date col-lg-3">
                        <input id="txtFechaFin" name="txtFechaFin" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control" data-provide="datepicker">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtEnlace">Enlace</label>
                    <div class="input-group">
                        <span class="input-group-addon">/</span>
                        <input type="text" class="form-control" id="txtEnlace" name="txtEnlace" placeholder="Enlace">
                    </div>
                </div>
                <div class="form-group">
                    <label for="file">Imágen</label> <small>(480x550px | Formato JPG)</small>
                    <input type="file" class="form-control" id="file" name="file" placeholder="Imágen"> <a href="../images/promociones/<?php echo $_GET['pID']; ?>.jpg" target="_blank">[Ver Imágen]</a>
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
                    <button type="submit" class="btn btn-success" id="btnGrabar"><span class="fa fa-check"></span> Guardar Promoción</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
