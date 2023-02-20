<?php
error_reporting(E_ALL);
  ini_set('display_errors', true);
/**
 * Insertar una nueva meta en la base de datos
 */

require 'DB/DB_Recibo.php';
//SIEMPRE SERA POST

if (!empty($_POST['_metod'])) {
	if(!empty($_POST['idAdmin']) && !empty($_POST['token'])){


			//es elAdmin
			if($_POST['_metod']=='getAll'){
				$result = DB_Recibo::getAll($_POST['idAdmin']);
				
				$data = '<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
		            <tr>
		                <th><center>idRecibo</center></th>
		                <th><center>Nombre</center></th>
		                <th><center>tipo</center></th>
		                <th><center>por Concepto</center></th>
		                <th><center>estado</center></th>
		                <th><center>fecha</center></th>
		                
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
							<td><center>'.$row['idRecibo'].'</center></td>
							<td><center>'.$row['ci'].'
								<br>'.$row['nombre'].'
								<br>'.$row['apPaterno'].'
								<br>'.$row['apMaterno'].'</center>
							</td>
							<td><center>'.$row['tipo'].'</center></td>
							<td><center>'.$row['porConcepto'].'</center></td>
							<td><center>'.$row['estado'].'</center></td>
							<td><center>'.$row['fecha'].'</center></td>
							
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
		                                 No se encontro ningun Recibo
		                            </div>
		                        </span>';
				}
				echo $data;
			}

			if($_POST['_metod']=='getById'){
				$retorno = DB_Recibo::getById($_POST['idRecibo']);
		        if ($retorno) {
		            $datos["estado"] = 1;
					$datos["recibo"] = $retorno;
					print json_encode($datos);
				} else {
					print json_encode(
						array(
							'estado' => 2,
							'mensaje' => 'Error al encontrar el recibo')
					);
				}
			}

			if($_POST['_metod']=='update'){
				$retorno = DB_Recibo::update(
			        $_POST['idRecibo'],
			        $_POST['tipo'],
				    $_POST['porConcepto'],
					$_POST['total'],
					$_POST['aCuenta'],
					$_POST['saldo'],
					$_POST['fechEntrega'],
					$_POST['descripcion'],
					$_POST['ganancia'],
				    $_POST['estado']);

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
				$retorno = DB_Recibo::insert(
		        $_POST['idAdmin'],
		        $_POST['idCliente'],
		        $_POST['tipo'],
			    $_POST['porConcepto'],
				$_POST['total'],
				$_POST['aCuenta'],
				$_POST['saldo'],
				$_POST['fechEntrega'],
				$_POST['descripcion'],
				$_POST['ganancia'],
			    $_POST['estado']);

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
				$retorno = DB_Recibo::delete($_POST['idRecibo']);
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


