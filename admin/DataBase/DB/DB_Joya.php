<?php

/**
 * Representa el la estructura de los Puntos
 * almacenados en la base de datos
 */
require 'Database.php';

class DB_Joya
{
    function __construct()
    {
    }
    public static function getAll($idAdmin)
    {
        $consulta = "SELECT * FROM joya  WHERE idAdmin = ?";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idAdmin));

            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function getById($idJoya)
    {
        // Consulta de la meta
        $consulta = "SELECT *
                             FROM joya
                             WHERE idJoya = ?";

        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idJoya));
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function insert(
        $idAdmin,
		$nombre,
		$descripcion,
		$inversion,
		$fecha
    )
    {
        $comando = "INSERT INTO joya ( " .
            " idAdmin," .
			" nombre," .
			" descripcion," .
			" inversion," .
            " fecha)" .
            " VALUES( ?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
		$sentencia->execute(array($idAdmin, $nombre, $descripcion, $inversion, $fecha));
        return $sentencia;

    }
    public static function update(
        $idJoya,
        $nombre,
		$descripcion,
		$inversion,
		$fecha
    )
    {

		$consulta = "UPDATE joya SET nombre = ?, descripcion = ?, inversion = ?, fecha = ? WHERE idJoya = ?;";
		$cmd = Database::getInstance()->getDb()->prepare($consulta);
		try {
				
			$cmd->execute(array($nombre,$descripcion, $inversion, $fecha,$idJoya));
				
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
    public static function delete($idJoya)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM joya WHERE idJoya=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idJoya));
    }
}

?>