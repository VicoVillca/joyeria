<?php
    $nombre="index.php";
    include("include/permisions.php"); 
?>

<?php
  include("include/head.php"); 
?>

<!-- Begin Page Content -->
                <div class="container-fluid">
					
					<?php
					  echo '<input type="hidden" id="hidden_id_admin" value="'.$_SESSION['idAdmin'].'">';
					  echo '<input type="hidden" id="hidden_token" value="'.$_SESSION['token'].'">';
					?>
                    <!-- Page Heading -->
                    
					<nav class="navbar  ">
						<div class="sidebar-brand-text mx-1"><h2>Proveedores <sup>(de servicios y productos)</sup></h2></div>
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
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                
                                <h4 class="modal-title" id="myModalLabel">Adicionar Nuevo Proveedor</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                 
                                <div class="form-group">
                                    <label for="first_name">Nombre</label>
                                    <input type="text" id="nombre" placeholder="Nombre" class="form-control" required/>
                                </div>
                 
                                <div class="form-group">
                                    <label for="last_name">celular</label>
                                    <input type="text" id="celular" placeholder="celular" class="form-control"/>
                                </div>
                 
                                <div class="form-group">
                                    <label for="email">descripcion</label>
                                    <input type="text" id="descripcion" placeholder="descripcion" class="form-control"/>
                                </div>

                 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addRecord()">Adicionar</button>
                            </div>
                        </div>
                    </div>
                </div>
                
					
                 
                <!-- Modal - Update User details -->
                <div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Editar Proveedor</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								
                                
                            </div>
                            <div class="modal-body">
                 
                                <div class="form-group">
                                    <label for="update_nombre">Nombre</label>
                                    <input type="text" id="update_nombre" placeholder="Nombre" class="form-control"/>
                                </div>
                 
                                <div class="form-group">
                                    <label for="update_celular">Celular</label>
                                    <input type="text" id="update_celular" placeholder="Celular" class="form-control"/>
                                </div>
                 
                                <div class="form-group">
                                    <label for="update_descripcion">Descripcion</label>
                                    <input type="text" id="update_descripcion" placeholder="Descripcion" class="form-control"/>
                                </div>
                 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Guardar Cambios</button>
                                <input type="hidden" id="hidden_user_id">
                            </div>
                        </div>
                    </div>
                </div>
				<!-- // Modal - delete -->
				<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar el proveedor?</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">Seleccione "Continuar" para eliminar el proveedor.</div>
							<div class="modal-footer">
								<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
								<a class="btn btn-danger" data-dismiss="modal" onclick="ConfirmarDeleteUser()">Continuar</a>
							</div>
						</div>
					</div>
				</div>
            

                </div>
                <!-- /.container-fluid -->


            <!-- /.container-fluid -->
    <!-- JavaScript -->
    <script src="js/proveedores.js"></script>  

<?php
  include("include/footer.php"); 
?>