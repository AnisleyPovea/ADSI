<?php

    require_once "Conexion.php";
    
    class Empleado{

        public static function getAll(){

            $stmt = Conexion::conectar()->prepare('SELECT * FROM view_empleados');

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_OBJ);

            $empleados = $stmt->fetchAll();

            # Cerrar conexion
            $stmt->closeCursor();
            $stmt = null;

            return $empleados;

        }

        public static function getById( $id ){}

        public static function save( $empleado ){}

       
    } 

