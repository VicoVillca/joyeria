<?php

/**
 * Representa el la estructura de los Puntos
 * almacenados en la base de datos
 */
require 'Database.php';

class DB_Admin
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'punto'
     *
     * @param $idPunto Identificador del registro
     * @return array Datos del registro
     */
   

    /**
     * Obtiene los campos de un punto con un identificador
     * determinado
     *
     * @param $idPunto Identificador del punto
     * @return mixed
     */
    public static function getByPasword($nombre,$pasword)
    {
        // Consulta de la meta
        $consulta = "SELECT idAdmin,token
                             FROM administrador
                             WHERE usuario = ? and pasword = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($nombre, $pasword));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	public static function getByIdAndToken($idAdmin,$token)
    {
        // Consulta de la meta
        $consulta = "SELECT *
                             FROM administrador
                             WHERE (idAdmin = ? and token =?)";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idAdmin, $token));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	public static function updateNewToken(
        $idAdmin,
        $token
    )
    {
        $token2 = substr( md5(microtime()), 1, 20);
        // Creando consulta UPDATE
        $consulta = "UPDATE administrador" .
            " SET token = ?" .
            "WHERE idAdmin = ? AND token = ?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($token2,$idAdmin, $token));

        return $cmd;
    }
}

?>