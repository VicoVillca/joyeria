<?php
error_reporting(E_ALL);
  ini_set('display_errors', true);
/**
 * Insertar una nueva meta en la base de datos
 */

require 'DB/DB_Joya.php';
//SIEMPRE SERA POST

if (!empty($_POST['_metod'])) {
	if(!empty($_POST['idAdmin']) && !empty($_POST['token'])){


			//es elAdmin
			if($_POST['_metod']=='getAll'){
				$result = DB_Joya::getAll($_POST['idAdmin']);
				
				$data = '<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
		            <tr>
		                <th><center>Codigo</center></th>
		                <th><center>Nombre</center></th>
						<th><center>Descripcion</center></th>
		                <th><center>Inversion</center></th>
		                <th><center>Fecha</center></th>
		                <th><center>Foto</center></th>
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
							<td><center>'.$row['idJoya'].'</center></td>
							<td><center>'.$row['nombre'].'</center></td>
							<td><center>'.$row['descripcion'].'</center></td>
							<td><center>'.$row['inversion'].'</center></td>
							<td><center>'.$row['fecha'].'</center></td>
							<td><center>foto</center></td>
							<td >
								<center>
									<button onclick="GetUserDetails('.$row['idJoya'].')" class="btn btn-warning">Editar</button>
								</center>
							</td>
							<td >
								<center>
									<button onclick="DeleteUser('.$row['idJoya'].')" class="btn btn-danger">Borrar</button>
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
				$retorno = DB_Joya::getById($_POST['idJoya']);
		        if ($retorno) {
		            $datos["estado"] = 1;
					$datos["joya"] = $retorno;
					print json_encode($datos);
				} else {
					print json_encode(
						array(
							'estado' => 2,
							'mensaje' => 'Error al encontrar la joya')
					);
				}
			}

			if($_POST['_metod']=='update'){
				$retorno = DB_Joya::update(
			        $_POST['idJoya'],
			        $_POST['nombre'],
			        $_POST['descripcion'],
					$_POST['inversion'],
			        $_POST['fecha']);

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
				$retorno = DB_Joya::insert(
		        $_POST['idAdmin'],
		        $_POST['nombre'],
			    $_POST['descripcion'],
				$_POST['inversion'],
			    $_POST['fecha']);

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
				$retorno = DB_Joya::delete($_POST['idJoya']);
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


