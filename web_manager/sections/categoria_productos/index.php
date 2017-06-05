<?php
$mod = $_GET['mod'];
if(empty($mod)) {
?>
    <script>
        $(document).ready(function () {
            var URL = 'sections/categoria_productos/categoria_productos.php?action=getCategorias&_t=' + new Date().getTime();
            $("#tabla-categorias").bootstrapTable({
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
                        window.location = 'panel.php?do=categoria_productos&mod=editar&pID=' + row.ID;
                    } else if(field == 3) {
                        var conf = confirm("¿Está seguro que desea eliminar la categoría " + row.NOMBRE + "?");
                        if(conf) {
                            var res = eliminarCategoria(row.ID);
                            if(res == '1') {
                                alert('Categoría eliminada con éxito');
                                refreshTabla("tabla-categorias");
                            } else {
                                alert('Error al eliminar.\n' + res);
                            }
                        }
                    }
                }
            });
        });
    </script>
    <h1 class="page-title">Administrar Categorías de Productos</h1>
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="panel.php"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><strong>Categorías de Productos</strong></li>
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
        <div class="col-sm-6">
            <h3 class="pull-left">Categorías</h3><button class="btn btn-primary btn-sm btn-add" id="btnNuevoHotel" style="margin-left: 15px;">Agregar Nuevo</button>
            <div class="table-responsive">
                <table id="tabla-categorias" data-toggle="table" data-search="false" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" class="table table-users table-hover" data-locale="es-ES">
                </table>
            </div>
        </div>
        <div class="col-sm-6">
            <h3 class="pull-left">Subcategorías</h3><button class="btn btn-primary btn-sm btn-add" id="btnNuevaHabitacion" style="margin-left: 15px;">Agregar Nuevo</button>
            <div class="table-responsive">
                <table id="tabla-subcategorias" data-toggle="table" data-search="false" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" class="table table-users table-hover" data-locale="es-ES">
                </table>
            </div>
        </div>
    </div>
<?php } ?>