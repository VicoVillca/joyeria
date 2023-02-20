<?php
error_reporting(E_ALL);
  ini_set('display_errors', true);
/**
 * Insertar una nueva meta en la base de datos
 */

require 'DB/DB_Cliente.php';
//SIEMPRE SERA POST

if (!empty($_POST['_metod'])) {
	if(!empty($_POST['idAdmin']) && !empty($_POST['token'])){


			//es elAdmin
			if($_POST['_metod']=='getAll'){
				$result = DB_Cliente::getAll($_POST['idAdmin']);
				
				$data = '<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
		            <tr>
		                <th><center>Ci</center></th>
		                <th><center>Nombre</center></th>
						<th><center>ApPaterno</center></th>
		                <th><center>ApMaterno</center></th>
		                <th><center>calificacion</center></th>
		                <th><center>descripcion</center></th>
		                <th><center>foto</center></th>
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
							<td><center>'.$row['ci'].'</center></td>
							<td><center>'.$row['nombre'].'</center></td>
							<td><center>'.$row['apPaterno'].'</center></td>
							<td><center>'.$row['apMaterno'].'</center></td>
							<td><center>'.$row['calificacion'].'</center></td>
							<td><center>'.$row['descripcion'].'</center></td>
							<td><center>foto</center></td>
							<td >
								<center>
									<button onclick="GetUserDetails('.$row['idCliente'].')" class="btn btn-warning">Editar</button>
								</center>
							</td>
							<td >
								<center>
									<button onclick="DeleteUser('.$row['idCliente'].')" class="btn btn-danger">Borrar</button>
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
		                                 No se encontro ninguna joya
		                            </div>
		                        </span>';
				}
				echo $data;
			}

			if($_POST['_metod']=='getById'){
				$retorno = DB_Cliente::getById($_POST['idCliente']);
		        if ($retorno) {
		            $datos["estado"] = 1;
					$datos["cliente"] = $retorno;
					print json_encode($datos);
				} else {
					print json_encode(
						array(
							'estado' => 2,
							'mensaje' => 'Error al encontrar el cliente')
					);
				}
			}

			if($_POST['_metod']=='update'){
				$retorno = DB_Cliente::update(
			        $_POST['idCliente'],
			        $_POST['ci'],
			        $_POST['nombre'],
			        $_POST['apPaterno'],
			        $_POST['apMaterno'],
					$_POST['calificacion'],
			        $_POST['descripcion']);

			        if ($retorno) {
			            print json_encode(
			                array(
			                    'estado' => 1,
			                    'mensaje' => 'Actualización exitosa'
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
				$retorno = DB_Cliente::insert(
		        $_POST['idAdmin'],
		        $_POST['ci'],
			    $_POST['nombre'],
				$_POST['apPaterno'],
				$_POST['apMaterno'],
				$_POST['calificacion'],
			    $_POST['descripcion']);

		        if ($retorno) {
		            print json_encode(
		                array(
		                    'estado' => 1,
		                    'mensaje' => 'Creación exitosa'
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
				$retorno = DB_Cliente::delete($_POST['idCliente']);
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
			if($_POST['_metod']=='buscarCliente'){
				$result = DB_Cliente::buscarCliente($_POST['idAdmin'],$_POST['data']);
				$data='';
				if(!empty($result)) {
					$data = '<ul id="country-list" >';
					foreach($result as $country) {
						$data .= '<li class="list-group-item" onClick="selectCountry('.$country["idCliente"].',\''.$country["nombre"].'\');">'.$country["nombre"].'</li>';
					}
					$data .= '</ul>';
				}
				echo $data;
				//echo print json_encode($result);
				/*if (true) {
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
				}*/
			}

		
	}else{
		//es podible que el que quiere acceder no es superAdmin
	}
}


