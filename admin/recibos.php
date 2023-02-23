<?php
$nombre = "index.php";
include("include/permisions.php");
?>

<?php
include("include/head.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php
    echo '<input type="hidden" id="hidden_id_admin" value="' . $_SESSION['idAdmin'] . '">';
    echo '<input type="hidden" id="hidden_token" value="' . $_SESSION['token'] . '">';
    ?>
    <!-- Page Heading -->

    <nav class="navbar  ">
        <div class="sidebar-brand-text mx-1">
            <h2>Recibos <sup>(orden de trabajo)</sup></h2>
        </div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">+ Agregar</button>

            </li>
        </ul>
    </nav>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">

            <div class="panel-body"></div>


        </div>
    </div>
    <!-- Bootstrap Modals -->
    <!-- Modal - Add New Record/User -->
    <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <font color="blue" class="modal-title" d="myModalLabel" size=7>RECIBO</font>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">

                        <label><strong>Cod: <font id="cod" color="red" size=5>554455</font></strong></label>

                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label><strong>Fecha: <input type="date" class="form-control" readonly value="<?php echo date("Y-m-d"); ?>"></strong></label>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">




                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label><strong>Recibi de:</strong></label>
                                <input type="search" id="search-box" placeholder="Nombre o  CI de cliente" class="form-control" autocomplete="off" />
                                <input type="hidden" id="hidden-search-box-id" value="">
                                <div id="suggesstion-box"></div>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label><strong>la suma de:</strong></label>
                                <input type="number" name="acuenta" id="acuenta" class="form-control" placeholder="Monto acuenta en bolivianos" required>
                                <font id="numeros" color="green" size=2></font>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">


                                <label for="multiLineInput"> <!-- Add the label if you want -->
                                    <p><strong>Por concepto de:</strong></p>
                                    <textarea rows="3" cols="100%"  name="porconcepto" id="porconcepto"></textarea>
                                </label>

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label><strong>Total:</strong></label>
                                <input type="number" name="total" id="total" class="form-control " placeholder="0" required>

                            </div>
                            <div class="col-md-4">
                                <label><strong>acuenta:</strong></label>
                                <input type="number" name="a_cuenta" id="a_cuenta" class="form-control" readonly placeholder="0" required>

                            </div>
                            <div class="col-md-4">
                                <label><strong>Saldo:</strong></label>
                                <input type="number" name="saldo" id="saldo" class="form-control" readonly placeholder="0" required>

                            </div>

                        </div>

                    </div>




                </div>
                <div class="modal-footer">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="row">
                            <div class="col-md-3">
                                <label><strong>Ingreso:</strong></label>
                                <input type="number" name="ingreso" id="ingreso" class="form-control " placeholder="0" required>

                            </div>
                            <div class="col-md-3">
                                <label><strong>Fecha Entrega:</strong></label>
                                <input type="date" id="fecha_entrega" name="trip-start">

                            </div>
                            <div class="col-md-6">
                                <label><strong></strong></label>
                                <button type="button" class="btn btn-primary form-control" data-dismiss="modal" onclick="addRecord()">Generar recibo</button>
                            </div>
                        </div>

                    </div>
                    <label><strong></strong></label>



                </div>

            </div>
        </div>
    </div>



    <!-- Modal - Update User details -->
    <div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Editar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="update_nombre">Ci</label>
                        <input type="text" id="update_ci" placeholder="Ci" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="update_nombre">Nombre</label>
                        <input type="text" id="update_nombre" placeholder="Nombre" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="update_ap_paterno">apPaterno</label>
                        <input type="text" id="update_ap_paterno" placeholder="apPaterno" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="update_ap_materno">apMaterno</label>
                        <input type="text" id="update_ap_materno" placeholder="apMaterno" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="update_calificacion">Calificacion</label>
                        <input type="text" id="update_calificacion" placeholder="Calificacion" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="update_descripcion">Descripcion</label>
                        <input type="text" id="update_descripcion" placeholder="Descripcion" class="form-control" />
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()">Guardar Cambios</button>
                    <input type="hidden" id="hidden_user_id">
                </div>
            </div>
        </div>
    </div>
    <!-- // Modal - delete -->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar el Cliente?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Continuar" para eliminar el cliente.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" data-dismiss="modal" onclick="ConfirmarDeleteUser()">Continuar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- // Modal - seleccionar Cliente -->
    <div class="modal fade" id="select_cliente_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar Cliente</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="search" id="search-box" placeholder="nombre o ci de cliente" class="form-control" />
                        <input type="hidden" id="hidden-search-box-id" value="">
                        <div id="suggesstion-box"></div>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->


<!-- /.container-fluid -->
<!-- JavaScript -->
<script src="js/recibos.js"></script>

<?php
include("include/footer.php");
?>