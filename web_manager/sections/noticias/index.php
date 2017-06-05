<?php
if(empty($mod)) {
    ?>
    <script>
        $(document).ready(function () {
            getNoticias();

            $("#btnNuevaNoticia").click(function () {
                window.location = 'panel.php?do=noticias&mod=nuevo';
            });
        });

        function getNoticias() {
            var URL = 'sections/noticias/noticias.php?action=getNoticias&_t=' + new Date().getTime();
            $('#tabla-noticias').bootstrapTable({
                url: URL,
                columns: [
                    {
                        field: 'ID',
                        title: 'Imágen',
                        align: 'center',
                        formatter: function (value) {
                            return '<img src="../images/noticias/' + value + '.jpg" width="24" height="24">';
                        }
                    },
                    {
                        field: 'TITULO',
                        title: 'Título',
                        sortable: true
                    },
                    {
                        field: 'FECHA_REG',
                        title: 'Fecha Registro',
                        align: 'center',
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
                    if (field == 3) {
                        window.location = 'panel.php?do=noticias&mod=editar&nID=' + row.ID;
                    } else if (field == 4) {
                        var conf = confirm("¿Está seguro que desea eliminar la noticia " + row.TITULO + "?");
                        if (conf) {
                            var res = eliminarNoticia(row.ID);
                            if (res == '1') {
                                alert('Noticia eliminada con éxito');
                                refreshTabla("tabla-noticias");
                            } else {
                                alert('Error al eliminar.\n' + res);
                            }
                        }
                    }
                }
            });
        }

        function eliminarNoticia(id) {
            var URL = 'sections/noticias/noticias.php?action=eliminar&nID=' + id + '&_t=' + new Date().getTime();
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
        <h1 class="page-title pull-left">Administrar Noticias</h1>
        <button class="btn btn-primary btn-sm btn-add" id="btnNuevaNoticia">Agregar Nuevo</button>
    </div>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><strong>Administrar Noticias</strong></li>
    </ol>
    <?php
    $status = $_GET['status'];
    $msg = $_GET['msg'];
    if($status == 'success') { ?>
        <div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Éxito!</strong> La noticia se grabó correctamente. </div>
    <?php } elseif($status == 'error') { ?>
        <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> Ocurrió un error al grabar la noticia. Por favor intente nuevamente.<br>Detalles del error: <?php echo $msg; ?></div>
    <?php } ?>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="tabla-noticias" data-toggle="table" data-search="true" data-show-refresh="true"
                       data-show-toggle="true" data-show-columns="true" class="table table-users table-hover"
                       data-locale="es-ES">
                </table>
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
                window.location = 'panel.php?do=noticias';
            });

            $("#btnGrabar").click(function (e) {
                e.preventDefault();

                var titulo = $("#txtTitulo").val();
                var contenido = $('#txtContenido').val();
                var enlace = $("#txtEnlace").val();

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

                $("#frmNuevaNoticia").submit();

            });
        });
    </script>
    <h1 class="page-title">Nueva Noticia</h1>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="panel.php?do=noticias">Administrar Noticias</a></li>
        <li class="active"><strong>Nueva Noticia</strong></li>
    </ol>
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <form id="frmNuevaNoticia" action="sections/noticias/noticias.php?action=grabar" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtTitulo">Título de la Noticia</label>
                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Título">
                </div>
                <div class="form-group">
                    <label for="txtContenido">Contenido</label>
                    <textarea id="txtContenido" name="txtContenido" text-editor="true">Hola Mundo!</textarea>
                </div>
                <div class="form-group">
                    <label for="txtEnlace">Enlace</label>
                    <div class="input-group">
                        <span class="input-group-addon">/</span>
                        <input type="text" class="form-control" id="txtEnlace" name="txtEnlace" placeholder="Enlace">
                    </div>
                </div>
                <div class="form-group">
                    <label for="file">Imágen</label>
                    <input type="file" class="form-control" id="file" name="file" placeholder="Imágen">
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
                    <button type="submit" class="btn btn-success" id="btnGrabar"><span class="fa fa-check"></span> Guardar Noticia</button>
                </div>
            </div>
        </div>
    </div>
    <?php
} elseif($mod == 'editar') {
    ?>
    <script>
        $(document).ready(function () {
            var URL = 'sections/noticias/noticias.php?action=getNoticia&nID=<?php echo $_GET['nID']; ?>&_t=' + new Date().getTime();
            $.ajax({
                async:false,
                url: URL,
                dataType: 'json',
                success: function(data) {
                    $("#txtTitulo").val(data.TITULO);
                    $("#txtContenido").summernote('code', data.CONTENIDO);
                    $("#txtEnlace").val(data.LINK);
                }
            });

            $("#btnCancelar").click(function () {
                window.location = 'panel.php?do=noticias';
            });

            $("#btnGrabar").click(function () {
                var titulo = $("#txtTitulo").val();
                var contenido = $('#txtContenido').val();
                var enlace = $("#txtEnlace").val();

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

                $("#frmEditarNoticia").submit();

            });
        });
    </script>
    <h1 class="page-title">Editar Promoción</h1>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="panel.php?do=noticias">Administrar Noticias</a></li>
        <li class="active"><strong>Editar Noticia</strong></li>
    </ol>
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <form id="frmEditarNoticia" action="sections/noticias/noticias.php?action=actualizar&nID=<?php echo $_GET['nID']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtTitulo">Título de la Noticia</label>
                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Título">
                </div>
                <div class="form-group">
                    <label for="txtContenido">Contenido</label>
                    <textarea id="txtContenido" name="txtContenido" text-editor="true">Hola Mundo!</textarea>
                </div>
                <div class="form-group">
                    <label for="txtEnlace">Enlace</label>
                    <div class="input-group">
                        <span class="input-group-addon">/</span>
                        <input type="text" class="form-control" id="txtEnlace" name="txtEnlace" placeholder="Enlace">
                    </div>
                </div>
                <div class="form-group">
                    <label for="file">Imágen</label>
                    <input type="file" class="form-control" id="file" name="file" placeholder="Imágen">
                    <a href="../images/noticias/<?php echo $_GET['nID']; ?>.jpg" target="_blank">[Ver Imágen]</a>
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
                    <button type="submit" class="btn btn-success" id="btnGrabar"><span class="fa fa-check"></span> Guardar Noticia</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
