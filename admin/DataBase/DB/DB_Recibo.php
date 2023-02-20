<?php

/**
 * Representa el la estructura de los Puntos
 * almacenados en la base de datos
 */
require 'Database.php';

class DB_Recibo
{
    function __construct()
    {
    }
    public static function getAll($idAdmin)
    {
        $consulta = "SELECT r.*, c.ci,c.nombre,c.apPaterno,c.apMaterno FROM recibo r, cliente c  WHERE idRecibo = ? and r.idCliente = c.idCliente";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idAdmin));

            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function getById($idRecibo)
    {
        // Consulta de la meta
        $consulta = "SELECT *
                             FROM recibo
                             WHERE idRecibo = ?";

        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idRecibo));
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function insert(
        $idAdmin,
		$idCliente,
		$tipo,
		$porConcepto,
        $total,
        $aCuenta,
        $saldo,
        $fechaEntrega,
        $descripcion,
        $ganancia,
        $estado
    )
    {
        $comando = "INSERT INTO cliente ( " .
            " idAdmin," .
			" idCliente," .
			" tipo," .
            " porConcepto," .
            " total," .
			" aCuenta," .
            " saldo," .
            " fecha," .
            " fechaEntrega," .
            " descripcion," .
            " ganancia," .
            " estado)" .
            " VALUES( ?,?,?,?,?,?,?,?,?,?,?,)";
        $fecha = '2021-08-02';
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
		$sentencia->execute(array($idAdmin, $idCliente,$tipo, $porConcepto, $total, $aCuenta, $saldo,$fecha,$fechaEntrega,$descripcion,$ganancia, $estado));
        return $sentencia;

    }
    public static function update(
        $idRecibo,
        $tipo,
        $porConcepto,
        $total,
        $aCuenta,
        $saldo,
        $fechaEntrega,
        $descripcion,
        $ganancia,
        $estado
    )
    {

		$consulta = "UPDATE recibo SET  tipo = ?, porConcepto = ?, total = ?, aCuenta = ?, saldo = ?,fechaEntrega = ?,descripcion = ?,ganancia = ?,estado = ? WHERE idRecibo = ?;";
		$cmd = Database::getInstance()->getDb()->prepare($consulta);
		try {
				
			$cmd->execute(array($tipo,$porConcepto,$total, $aCuenta, $saldo,$fechaEntrega,$descripcion,$ganancia,$estado, $idRecibo));
				
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
    public static function delete($idRecibo)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM recibo WHERE idRecibo=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idRecibo));
    }
}

?>