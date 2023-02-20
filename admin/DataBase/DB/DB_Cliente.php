<?php

/**
 * Representa el la estructura de los Puntos
 * almacenados en la base de datos
 */
require 'Database.php';

class DB_Cliente
{
    function __construct()
    {
    }
    public static function getAll($idAdmin)
    {
        $consulta = "SELECT * FROM cliente  WHERE idAdmin = ?";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idAdmin));

            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function buscarCliente($idAdmin,$data)
    {
        $consulta = "SELECT idCliente,CONCAT(`ci`,' ',`nombre`,' ',`apPaterno`,' ',`apMaterno`) as nombre FROM `cliente` WHERE CONCAT(`ci`,`nombre`,`apPaterno`,`apMaterno`) LIKE '%".$data."%'";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idAdmin));

            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function getById($idCliente)
    {
        // Consulta de la meta
        $consulta = "SELECT *
                             FROM cliente
                             WHERE idCliente = ?";

        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idCliente));
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function insert(
        $idAdmin,
		$ci,
		$nombre,
		$apPaterno,
		$apMaterno,
        $calificacion,
        $descripcion
    )
    {
        $comando = "INSERT INTO cliente ( " .
            " idAdmin," .
			" ci," .
			" nombre," .
            " apPaterno," .
            " apMaterno," .
			" calificacion," .
            " descripcion)" .
            " VALUES( ?,?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
		$sentencia->execute(array($idAdmin, $ci, $nombre, $apPaterno, $apMaterno, $calificacion, $descripcion));
        return $sentencia;

    }
    public static function update(
        $idCliente,
        $ci,
        $nombre,
        $apPaterno,
        $apMaterno,
        $calificacion,
        $descripcion
    )
    {

		$consulta = "UPDATE cliente SET  ci = ?, nombre = ?, apPaterno = ?, apMaterno = ?, calificacion = ?,descripcion = ? WHERE idCliente = ?;";
		$cmd = Database::getInstance()->getDb()->prepare($consulta);
		try {
				
			$cmd->execute(array($ci,$nombre,$apPaterno, $apMaterno, $calificacion,$descripcion, $idCliente));
				
			return $cmd;
		} catch (PDOException $e) {
			return false;
		}
        
    }


    /**
     * Eliminar el punto con el identificador especificado
     *
     * @param $idPunto identificador del Punto
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idCliente)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM cliente WHERE idCliente=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idCliente));
    }
}

?>