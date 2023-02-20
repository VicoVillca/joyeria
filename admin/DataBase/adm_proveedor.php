<?php
error_reporting(E_ALL);
  ini_set('display_errors', true);
/**
 * Insertar una nueva meta en la base de datos
 */

require 'DB/DB_Proveedor.php';
//SIEMPRE SERA POST

if (!empty($_POST['_metod'])) {
	if(!empty($_POST['idAdmin']) && !empty($_POST['token'])){


			//es elAdmin
			if($_POST['_metod']=='getAll'){
				$result = DB_Proveedor::getAll($_POST['idAdmin']);
				
				$data = '<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
		            <tr>
		                <th><center>No.</center></th>
		                <th><center>Nombre</center></th>
		                <th><center>celular</center></th>
						<th><center>descripcion</center></th>
		                <th><center>Editar</center></th>
		                <th><center>Borrar</center></th>
		             
		            </tr>
				</thead>
				<tbody>';
				if ($result) {
					$number = 1;
					foreach ($result as $row) {
					
						$data .= '
						<tr >
							<td><center>'.$number.'</center></td>
							<td><center>'.$row['nombre'].'</center></td>
							<td><center>'.$row['celular'].'</center></td>
							
							<td >'.$row['descripcion'].'</td>
							<td >
								<center>
									<button onclick="GetUserDetails('.$row['idProveedor'].')" class="btn btn-warning">Editar</button>
								</center>
							</td>
							<td >
								<center>
									<button onclick="DeleteUser('.$row['idProveedor'].')" class="btn btn-danger">Borrar</button>
								</center>
							</td>

						</tr>
						';
						$number++;
					}
					$data .= '</tbody>
					</table>';
				} else {
					$data='<span id="mensaje">
		                            <div class="alert alert-danger alert-dismissable">
		                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                 No se encontro ningun proveedor
		                            </div>
		                        </span>';
				}
				echo $data;
			}

			if($_POST['_metod']=='getById'){
				$retorno = DB_Proveedor::getById($_POST['idProveedor']);
		        if ($retorno) {
		            $datos["estado"] = 1;
					$datos["proveedor"] = $retorno;
					print json_encode($datos);
				} else {
					print json_encode(
						array(
							'estado' => 2,
							'mensaje' => 'Erro al encontrar el proveedor')
					);
				}
			}

			if($_POST['_metod']=='update'){
				$retorno = DB_Proveedor::update(
			        $_POST['idProveedor'],
			        $_POST['nombre'],
			        $_POST['celular'],
			        $_POST['descripcion']);

			        if ($retorno) {
			            print json_encode(
			                array(
			                    'estado' => 1,
			                    'mensaje' => 'Actualización exitosa'//,
			                    )
			            );

					} else {
						print json_encode(
							array(
								'estado' => 2,
								'mensaje' => 'Actualización fallida')
						);
				}
			}
			if($_POST['_metod']=='insert'){
				$retorno = DB_Proveedor::insert(
		        $_POST['idAdmin'],
		        $_POST['nombre'],
		        $_POST['celular'],
		        $_POST['descripcion']);

		        if ($retorno) {
		            print json_encode(
		                array(
		                    'estado' => 1,
		                    'mensaje' => 'Creación exitosa',
							'retorno' => $retorno
		                    )
		            );

				} else {
					// Código de falla
					print json_encode(
						array(
							'estado' => 2,
							'mensaje' => 'Creación fallida')
					);
				}
			}
			if($_POST['_metod']=='delete'){
				$retorno = DB_Proveedor::delete($_POST['idProveedor']);
				if ($retorno) {
					print json_encode(
						array(
							'estado' => 1,
							'mensaje' => 'Eliminación exitosa')
						);
				} else {
					print json_encode(
						array(
							'estado' => 2,
							'mensaje' => 'Eliminación fallida')
					);
				}
			}

		
	}else{
		//es podible que el que quiere acceder no es superAdmin
	}
}


