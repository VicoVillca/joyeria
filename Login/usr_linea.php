<?php
/**
 * Insertar una nueva meta en la base de datos
 */

require '../admin/DataBase/DB/DB_Linea.php';
require '../admin/DataBase/DB/cripto.php';

if (!empty($_POST['idLinea'])||!empty($_POST['cadena'])) {
	if($_POST['token'] == tok){
		if($_POST['_metod']=='getId'){
			$lineas = DB_Linea::getByIdUser(desencriptar($_POST['idLinea']));
			
			if ($lineas) {
				$datos["estado"] = 1;
				if (file_exists('../'.$lineas['foto'])){
					$datos["detalle"] = $lineas['foto'];
				}else{
					//no existe una foto de la linea
					$datos["detalle"] = 'img/Lineas/defaut.png';
				}
				
				print json_encode($datos);
			} else {
				print json_encode(array(
					"estado" => 2,
					"mensaje" => 'img/Lineas/error.png'
				));
			}
		}
	}
	if($_POST['_metod']=='Buscar' ){
		if(ltrim($_POST['cadena'])!=''){
			$lineas= DB_Linea::BuscarLinea($_POST['cadena']);
			if ($lineas) {
				print json_encode(
					array(
						'estado' => 1,
						'lineas' => $lineas)
				);
			} else {
				print json_encode(
					array(
						'estado' => 2,
						'mensaje' => 'Sin Resultados')
				);
			}
		}else{
			print json_encode(
				array(
					'estado' => 2,
					'mensaje' => 'Sin Resultados')
			);
		}
	}
	/*if($_POST['token'] == token){

		if($_POST['_metod']=='getId'){
			$lineas = DB_Linea::getByIdUser($_POST['idLinea']);
			$paradas= DB_Linea::getByIdParadas($_POST['idLinea']);
			if ($lineas) {
				$datos["estado"] = 1;
				$datos["detalle"] = $lineas;
				$datos["paradas"] = $paradas;
				print json_encode($datos);
			} else {
				print json_encode(array(
					"estado" => 2,
					"mensaje" => "Ha ocurrido un error"
				));
			}
		}
	}else{
		print json_encode(array(
					"estado" => 2,
					"mensaje" => "Token Incorrecto"
				));
	}*/
} 

