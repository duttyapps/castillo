<?php
if(empty($mod)) {
?>
    <script>
        $(document).ready(function () {
            getProductos();

            $("#btnNuevoProducto").click(function () {
                window.location = 'panel.php?do=productos&mod=nuevo';
            });
        });

        function getProductos() {
            var URL = 'sections/productos/productos.php?action=getProductos&_t=' + new Date().getTime();
            $('#tabla-productos').bootstrapTable({
                url: URL,
                columns: [
                    {
                        field: 'ID',
                        title: 'Imágen',
                        align: 'center',
                        formatter: function (value) {
                            return '<img src="../images/products/' + value + '.jpg" width="24" height="24">';
                        }
                    },
                    {
                        field: 'NOMBRE',
                        title: 'Nombre',
                        sortable: true
                    },
                    {
                        field: 'FECHA_REG',
                        title: 'Fecha Registro',
                        align: 'center',
                        sortable: true
                    },
                    {
                        field: 'ACTIVO',
                        title: 'Estado',
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
                    if (field == 4) {
                        window.location = 'panel.php?do=noticias&mod=editar&nID=' + row.ID;
                    } else if (field == 5) {
                        var conf = confirm("¿Está seguro que desea eliminar el producto " + row.TITULO + "?");
                        if (conf) {
                            var res = eliminarNoticia(row.ID);
                            if (res == '1') {
                                alert('Producto eliminado con éxito');
                                refreshTabla("tabla-noticias");
                            } else {
                                alert('Error al eliminar.\n' + res);
                            }
                        }
                    }
                }
            });
        }
    </script>
    <div class="page-heading clearfix">
        <h1 class="page-title pull-left">Administrar Productos</h1>
        <button class="btn btn-primary btn-sm btn-add" id="btnNuevoProducto">Agregar Nuevo</button>
    </div>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><strong>Productos</strong></li>
    </ol>
    <?php
    $status = $_GET['status'];
    $msg = $_GET['msg'];
    if($status == 'success') { ?>
        <div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Éxito!</strong> El producto se grabó correctamente. </div>
    <?php } elseif($status == 'error') { ?>
        <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> Ocurrió un error al grabar el producto. Por favor intente nuevamente.<br>Detalles del error: <?php echo $msg; ?></div>
    <?php } ?>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="tabla-productos" data-toggle="table" data-search="true" data-show-refresh="true"
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
            getCategorias();

            $("#txtNombre").change(function () {
                $("#txtEnlace").val($("#txtNombre").val().cleanup());
            });

            $("#btnGrabar").click(function (e) {
                e.preventDefault();

                var cat = $("#cboCategoria").val();
                var nombre = $("#txtNombre").val();
                var descripcion = $('#txtDescripcion').val();
                var enlace = $("#txtEnlace").val();
                var precio = $('#txtPrecio').val();

                if(cat == '') {
                    alert('Error: La CATEGORÍA no puede estar vacía.');
                    return;
                } else if(nombre == '') {
                    alert('Error: El NOMBRE no puede estar vacío.');
                    return;
                } else if(descripcion == '') {
                    alert('Error: La DESCRIPCIÓN no puede estar vacío.');
                    return;
                } else if(enlace == '') {
                    alert('Error: El ENLACE no puede estar vacío.');
                    return;
                } else if(precio == '') {
                    alert('Error: El PRECIO no puede estar vacío.');
                    return;
                }

                $("#frmNuevoProducto").submit();

            });
        });

        function getCategorias() {
            var URL = 'sections/categoria_productos/categoria_productos.php?action=getCategorias&_t=' + new Date().getTime();
            $.ajax({
                async:false,
                url: URL,
                dataType: 'json',
                success: function(data) {
                    $("#cboCategoria").html(new Option('Seleccionar Categoría', ''));
                    for(var i=0;i<data.length;i++) {
                        $("#cboCategoria").append(new Option(data[i].NOMBRE, data[i].ID));
                    }
                }
            });
        }
    </script>
    <h1 class="page-title">Nuevo Producto</h1>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="panel.php?do=productos">Productos</a></li>
        <li class="active"><strong>Nuevo Producto</strong></li>
    </ol>
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <form id="frmNuevoProducto" action="sections/productos/productos.php?action=grabar" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="cboCategoria">Categoría</label>
                    <select id="cboCategoria" name="cboCategoria" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtNombre">Nombre del Producto</label>
                    <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="txtPrecio">Precio</label>
                    <div class="input-group">
                        <span class="input-group-addon">S/.</span>
                        <input type="number" id="txtPrecio" name="txtPrecio" class="form-control" placeholder="Precio">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtDescripcion">Descripción</label>
                    <textarea id="txtDescripcion" name="txtDescripcion" text-editor="true">Hola Mundo!</textarea>
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
                <div class="form-group">
                    <label for="txtEnlace">Enlace</label>
                    <div class="input-group">
                        <span class="input-group-addon">/</span>
                        <input type="text" class="form-control" id="txtEnlace" name="txtEnlace" placeholder="Enlace">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtStock">Stock</label>
                    <input type="number" class="form-control" id="txtStock" name="txtStock" placeholder="Stock" value="5">
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
}
?>
