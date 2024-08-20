<?php
require_once "models/Persona.php";
class PersonaController{
public function gestor(){ 
    $personas = Persona::getAll();

    viewComponent( 'persona/gestor.php',[
        'page_title' => 'Gestor de personas',
        'header_title' => 'Gestor de personas',
        'lista_personas' => $personas
        ]);
        
}

public function crear(){ 
    $generos = Persona::getAllGeneros();
viewComponent( 'persona/formulario.php',[
'page_title' => 'Crear persona',
'header_title' => 'Gestor de personas',
'header_subtitle' => 'Crear persona',
'header_url' => 'persona/gestor',
'lista_generos' => $generos
] );

}

public function guardar(){ 
    #validar el método HTTP
if ($_SERVER['REQUEST_METHOD']=='POST') {
    # Regla de validación
    $rules=[
    'nro_documento' => ['required', '/^[a-zA-Z0-9]+$/'],
    'nombres' => ['required', '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
    'apellidos' => ['required', '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
    'genero'=>['nullable'],
    'fecha_nacimiento'=>['nullable']
    ];
    # Mensajes personalizados
    $mensaje = [
    'nro_documento' => 'número de documento',
    'nombres' => 'nombres',
    'apellidos' => 'apellidos',
    'genero' => 'genero',
    'fecha_nacimiento' => 'fecha de nacimiento'
    ];
    # Validar formulario
    $errors = validateForm($_REQUEST,$rules,$mensaje);
    # Validar si hay errores
    if(count($errors)){
    #Redireccionar al formulario crear
    redirectToRoute('persona/crear');
    }
    $persona = [
    trim($_REQUEST['nro_documento']),
    trim($_REQUEST['nombres']),
    trim($_REQUEST['apellidos']),
    $_REQUEST['fecha_nacimiento'],
    $_REQUEST['genero']
    ];
    $guardar = Persona::save($persona);
    if($guardar){
    $_SESSION['exito'] = 'El registro ha sido guardado.';
    redirectToRoute('persona/gestor');
    }
    $_SESSION["error404"] = 'Error al guardar, por favor comuniquese con el administrador.';
    redirectToRoute('persona/crear');
    }
    }
    
    


public function ver(){ }
public function editar(){ }
public function actualizar(){ }
public function eliminar(){ }
}