<?php
if(empty($mod)) {
?>
<script>
    $(document).ready(function () {
        var URL = 'sections/servicios/servicios.php?action=getServicios&_t=' + new Date().getTime();

        $('#tabla-servicios').bootstrapTable({
            url: URL,
            columns: [
                {
                    field: 'TITULO',
                    title: 'Título'
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
                    field: 'LINK',
                    title: 'Enlace',
                    formatter: function (v) {
                        return '/' + v;
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
                if(field == 3) {
                    window.location = 'panel.php?do=servicios&mod=editar&pID=' + row.ID;
                } else if(field == 4) {
                    var conf = confirm("¿Está seguro que desea eliminar el servicio " + row.TITULO + "?");
                    if(conf) {
                        var res = eliminarPagina(row.ID);
                        if(res == '1') {
                            alert('Servicio eliminada con éxito');
                            refreshTabla("tabla-servicios");
                        } else {
                            alert('Error al eliminar.\n' + res);
                        }
                    }
                } else {
                    cargaCambioEstado(row);
                }
            }
        });
        
        $("#btnCambiarEstado").click(function () {
            var id = $("#hdnID").val();
            if(id.length > 0) {
                var estado = $("input[name='rdEstado']").groupVal();
                var res = cambiarEstado(id, estado);
                if (res == '1') {
                    alert('Estado actualizado con éxito.');
                } else {
                    alert('Error al actualizar: ' + res);
                }
                refreshTabla("tabla-servicios");
            } else {
                return;
            }
        });

        $("#btnNuevaPagina").click(function () {
            window.location = 'panel.php?do=servicios&mod=nuevo';
        });
    });

    function cargaCambioEstado(data) {
        $("#pagina-titulo").html(data.TITULO);
        $("#hdnID").val(data.ID);
        if(data.ACTIVO == '1') {
            $("#rdActivo").prop("checked", true);
        } else {
            $("#rdInactivo").prop("checked", true);
        }
    }

    function cambiarEstado(id, estado) {
        var URL = 'sections/servicios/servicios.php?action=actualizarEstado&pID=' + id + '&est=' + estado + '&_t=' + new Date().getTime();
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

    function eliminarPagina(id) {
        var URL = 'sections/servicios/servicios.php?action=eliminar&pID=' + id + '&_t=' + new Date().getTime();
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

<div class="page-heading clearfix">
    <h1 class="page-title pull-left">Servicios</h1><button class="btn btn-primary btn-sm btn-add" id="btnNuevaPagina">Agregar Nuevo</button>
</div>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><strong>Servicios</strong></li>
    </ol>
    <?php
    $status = $_GET['status'];
    $msg = $_GET['msg'];
    if($status == 'success') { ?>
        <div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Éxito!</strong> La página se grabó correctamente. </div>
    <?php } elseif($status == 'error') { ?>
        <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> Ocurrió un error al grabar el servicio. Por favor intente nuevamente.<br>Detalles del error: <?php echo $msg; ?></div>
    <?php } ?>
<div class="row">
    <div class="col-sm-8 col-xs-12">
        <div class="table-responsive">
            <table id="tabla-servicios" data-toggle="table" data-search="true" data-show-refresh="true" data-show-toggle="false" data-show-columns="true" class="table table-users table-hover" data-locale="es-ES">
            </table>
        </div>
    </div>
    <div class="col-sm-4 col-xs-12">
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
            $("#txtTitulo").change(function () {
                $("#txtEnlace").val($("#txtTitulo").val().cleanup());
            });

            $("#btnCancelar").click(function () {
                window.location = 'panel.php?do=servicios';
            });

            $("#btnGrabar").click(function () {
                var titulo = $("#txtTitulo").val();
                var contenido = $('#txtContenido').summernote('code');
                var enlace = $("#txtEnlace").val();
                var estado = $("input[name='rdEstado']").groupVal();

                if(titulo == '') {
                    alert('Error: El TÍTULO no puede estar vacío.');
                    return;
                } else if(contenido == '') {
                    alert('Error: El CONTENIDO no puede estar vacío.');
                    return;
                } else if(enlace == '') {
                    alert('Error: El ENLACE no puede estar vacío.');
                    return;
                }

                grabarPagina(titulo, contenido, enlace, estado);
            });
        });

        function grabarPagina(titulo, contenido, enlace, estado) {
            var URL = 'sections/servicios/servicios.php?action=grabar&_t=' + new Date().getTime();
            var data = {
                p_titulo: titulo,
                p_contenido: contenido,
                p_enlace: enlace,
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
                        window.location = 'panel.php?do=servicios&status=success';
                    } else {
                        window.location = 'panel.php?do=servicios&status=error&msg=' + data;
                    }
                }
            });
        }
    </script>
    <h1 class="page-title">Nueva Servicio</h1>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="panel.php?do=servicios">Servicios</a></li>
        <li class="active"><strong>Nueva Servicio</strong></li>
    </ol>
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <form>
                <div class="form-group">
                    <label for="txtTitulo">Título</label>
                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Título">
                </div>
                <div class="form-group">
                    <label for="txtContenido">Contenido</label>
                    <div id="txtContenido" text-editor="true">Hola Mundo!</div>
                </div>
                <div class="form-group">
                    <label for="txtEnlace">Enlace</label>
                    <div class="input-group">
                        <span class="input-group-addon">/</span>
                        <input type="text" class="form-control" id="txtEnlace" name="txtEnlace" placeholder="Enlace">
                    </div>
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
                    <button type="submit" class="btn btn-success" id="btnGrabar"><span class="fa fa-check"></span> Guardar Servicio</button>
                </div>
            </div>
        </div>
    </div>
    <?php
} elseif($mod == 'editar') {
?>
    <script>
        $(document).ready(function () {
            var URL = 'sections/servicios/servicios.php?action=getServicio&pID=<?php echo $_GET['pID']; ?>&_t=' + new Date().getTime();
            $.ajax({
                async:false,
                url: URL,
                dataType: 'json',
                success: function(data) {
                    $("#txtTitulo").val(data.TITULO);
                    $("#txtContenido").summernote('code', data.CONTENIDO);
                    $("#txtEnlace").val(data.LINK);
                    if(data.ACTIVO == '1') {
                        $("#rdActivo").prop("checked", true);
                    } else {
                        $("#rdInactivo").prop("checked", true);
                    }
                }
            });

            $("#btnCancelar").click(function () {
                window.location = 'panel.php?do=servicios';
            });

            $("#btnGrabar").click(function () {
                var titulo = $("#txtTitulo").val();
                var contenido = $('#txtContenido').summernote('code');
                var enlace = $("#txtEnlace").val();
                var estado = $("input[name='rdEstado']").groupVal();

                if(titulo == '') {
                    alert('Error: El TÍTULO no puede estar vacío.');
                    return;
                } else if(contenido == '') {
                    alert('Error: El CONTENIDO no puede estar vacío.');
                    return;
                } else if(enlace == '') {
                    alert('Error: El ENLACE no puede estar vacío.');
                    return;
                }

                actualizarPagina(titulo, contenido, enlace, estado);
            });
        });

        function actualizarPagina(titulo, contenido, enlace, estado) {
            var URL = 'sections/servicios/servicios.php?action=actualizar&pID=<?php echo $_GET['pID']; ?>&_t=' + new Date().getTime();
            var data = {
                p_titulo: titulo,
                p_contenido: contenido,
                p_enlace: enlace,
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
                        window.location = 'panel.php?do=servicios&status=success';
                    } else {
                        window.location = 'panel.php?do=servicios&status=error&msg=' + data;
                    }
                }
            });
        }
    </script>
<h1 class="page-title">Editar Servicio</h1>
<ol class="breadcrumb breadcrumb-2">
    <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
    <li><a href="panel.php?do=servicios">Servicios</a></li>
    <li class="active"><strong>Editar Servicio</strong></li>
</ol>
<div class="row">
    <div class="col-sm-8 col-xs-12">
        <form id="frmServicios" method="post" action="sections/servicios.php?action=grabar">
            <div class="form-group">
                <label for="txtTitulo">Título</label>
                <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="txtContenido">Contenido</label>
                <div id="txtContenido" text-editor="true">Hola Mundo!</div>
            </div>
            <div class="form-group">
                <label for="txtEnlace">Enlace</label>
                <div class="input-group">
                    <span class="input-group-addon">/</span>
                    <input type="text" class="form-control" id="txtEnlace" name="txtEnlace" placeholder="Enlace">
                </div>
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
                <button type="submit" class="btn btn-success" id="btnGrabar"><span class="fa fa-check"></span> Actualizar</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
