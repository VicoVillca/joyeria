<?php

/**
 * Representa el la estructura de los Puntos
 * almacenados en la base de datos
 */
require 'Database.php';

class DB_Proveedor
{
    function __construct()
    {
    }
    public static function getAll($idAdmin)
    {
        $consulta = "SELECT * FROM proveedor  WHERE idAdmin = ?";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idAdmin));

            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function getById($idProveedor)
    {
        // Consulta de la meta
        $consulta = "SELECT *
                             FROM proveedor
                             WHERE idProveedor = ?";

        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idProveedor));
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function insert(
        $idAdmin,
		$nombre,
		$celular,
		$descripcion
    )
    {
        $comando = "INSERT INTO proveedor ( " .
            " idAdmin," .
			" nombre," .
			" celular," .
            " descripcion)" .
            " VALUES( ?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
		$sentencia->execute(array($idAdmin, $nombre, $celular, $descripcion));
        return $sentencia;

    }
    public static function update(
        $idProveedor,
        $nombre,
        $celular,
		$descripcion
    )
    {

		$consulta = "UPDATE proveedor SET nombre = ?, celular = ?, descripcion = ? WHERE idProveedor = ?;";
		$cmd = Database::getInstance()->getDb()->prepare($consulta);
		try {
				
			$cmd->execute(array($nombre, $celular,$descripcion,$idProveedor));
				
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
    public static function delete($idProveedor)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM proveedor WHERE idProveedor=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idProveedor));
    }
}

?>