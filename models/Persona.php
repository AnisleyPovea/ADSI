<?php
require_once "Conexion.php";
class Persona {
public static function getAll( ){ 
    $stmt = Conexion::conectar()->prepare('SELECT * FROM view_personas');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $personas = $stmt->fetchAll();
    # Cerrar la conexión
    $stmt->closeCursor();
    $stmt = null;
    return $personas;

}
public static function getById( $id ){ }
public static function save( $persona ){

    $query = 'CALL insertarPersona(?,?,?,?,?);';
$stmt = Conexion::conectar()->prepare( $query );
$res = $stmt->execute( $persona );
# Cerrar conexión
$stmt->closeCursor();
$stmt = null;
return $res;
 }

 public static function getAllGeneros (){
    $stmt = Conexion::conectar()->prepare('SELECT * FROM sgp_generos');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $generos = $stmt->fetchAll();
    # Cerrar conexion
    $stmt->closeCursor();
    $stmt = null;
    return $generos;
 }
    

public static function update( $persona ){ }
public static function delete( $id ){ }
}
