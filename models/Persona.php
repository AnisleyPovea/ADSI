<?php
require_once "Conexion.php";
class Persona
{
    public static function getAll()
    {
        $stmt = Conexion::conectar()->prepare('SELECT * FROM view_personas');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $personas = $stmt->fetchAll();
        # Cerrar la conexión
        $stmt->closeCursor();
        $stmt = null;
        return $personas;
    }
    public static function getById($id)
    {
        $stmt = Conexion::conectar()->prepare('CALL buscarPersonaPorId(?);');
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $persona = $stmt->fetch();

        # Cerrar conexión
        $stmt->closeCursor();
        $stmt = null;

        return $persona;
    }
    public static function save($persona)
    {

        $query = 'CALL insertarPersona(?,?,?,?,?);';
        $stmt = Conexion::conectar()->prepare($query);
        $res = $stmt->execute($persona);
        # Cerrar conexión
        $stmt->closeCursor();
        $stmt = null;
        return $res;
    }

    public static function getAllGeneros()
    {
        $stmt = Conexion::conectar()->prepare('SELECT * FROM sgp_generos');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $generos = $stmt->fetchAll();
        # Cerrar conexion
        $stmt->closeCursor();
        $stmt = null;
        return $generos;
    }


    public static function update($persona) {
        $query = 'CALL actualizarPersona(?,?,?,?,?,?,?);';
        $stmt = Conexion::conectar()->prepare($query);
        $res = $stmt->execute($persona);
        # Cerrar conexión
        $stmt->closeCursor();
        $stmt = null;
        return $res;
    }
    

    public static function delete($persona)
    {
        
        $query = "UPDATE sgp_personas SET estado = 'Inactivo' WHERE id = ?";
        $stmt = Conexion::conectar()->prepare($query);
        $stmt->bindParam(1, $persona, PDO::PARAM_INT);

        $res = $stmt->execute();
        # Cerrar conexión
        $stmt->closeCursor();
        $stmt = null;

        return $res;
    }

}
