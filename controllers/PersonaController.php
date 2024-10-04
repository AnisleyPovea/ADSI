<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/adsi/models/Persona.php';

class PersonaController{
    public function gestor()
    {
        $personas = Persona::getAll();

        viewComponent('persona/gestor.php', [
            'page_title' => 'Gestor de personas',
            'header_title' => 'Gestor de personas',
            'lista_personas' => $personas
        ]);
    }

    public function crear()
    {
        $generos = Persona::getAllGeneros();
        viewComponent('persona/formulario.php', [
            'page_title' => 'Crear persona',
            'header_title' => 'Gestor de personas',
            'header_subtitle' => 'Crear persona',
            'header_url' => 'persona/gestor',
            'lista_generos' => $generos
        ]);
    }

    public function guardar()
    {
        #validar el método HTTP
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # Regla de validación
            $rules = [
                'nro_documento' => ['required', '/^[a-zA-Z0-9]+$/'],
                'nombres' => ['required', '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
                'apellidos' => ['required', '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
                'genero' => ['nullable'],
                'fecha_nacimiento' => ['nullable']
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
            $errors = validateForm($_REQUEST, $rules, $mensaje);
            # Validar si hay errores
            if (count($errors)) {
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
            if ($guardar) {
                $_SESSION['exito'] = 'El registro ha sido guardado.';
                redirectToRoute('persona/gestor');
            }
            $_SESSION["error404"] = 'Error al guardar, por favor comuniquese con el administrador.';
            redirectToRoute('persona/crear');
        }
    }




    public function ver()
    {
        if (isset($_REQUEST['id']) && (int) $_REQUEST['id'] >= 1) {
            $id_persona = $_REQUEST['id'];
            $persona = Persona::getById($id_persona);

            if (is_object($persona)) {
                viewComponent('persona/detalle.php', [
                    'page title' => 'Detalle empleado',
                    'header_title' => 'Gestor de empleados',
                    'headeer_subtitle' => 'Detalle empleado',
                    'header_url' => 'empleadoempresa/gestor',
                    'persona' => $persona
                ]);
            } else {
                error404();
            }
        } else {
            error404();
        }
    }
    public function editar()
    {
        # Validar si existe el Id en la solicitud
        if (isset($_REQUEST['id']) && (int) $_REQUEST['id'] >= 1) {
            $id_persona = $_REQUEST['id'];
            $persona = Persona::getById($id_persona);
            # Validar si no existe en empleado
            if (is_object($persona)) {
                $generos = Persona::getAllGeneros();
                viewComponent('persona/formulario.php', [
                    'page_title' => 'Editar persona',
                    'header_title' => 'Gestor empleados',
                    'header_subtitle' => 'Editar empleado',
                    'header_url' => 'persona/gestor',
                    'lista_generos' => $generos,
                    'persona' => $persona
                ]);
            } else {
                error404();
            }
        } else {
            error404();
        }
    }
    public function actualizar()
    {
        if (
            $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['usuario_id']) &&

            (int) $_REQUEST['usuario_id'] >= 1
        ) {
            # Obtener el id
            $persona_id = $_REQUEST['usuario_id'];
            $rules = [
                'nro_documento' => ['required', '/^[a-zA-Z0-9]+$/'],
                'nombres' => ['required', '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
                'apellidos' => ['required', '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
                'genero' => ['nullable'],
                'fecha_nacimiento' => ['nullable']
            ];
            $mensaje = [
                'nro_documento' => 'número de documento',
                'nombres' => 'nombres',
                'apellidos' => 'apellidos',
                'genero' => 'genero',
                'fecha_nacimiento' => 'fecha de nacimiento'
            ];
            $errors = validateForm($_REQUEST, $rules, $mensaje, $persona_id);
            # Validar si hay errores
            if (count($errors)) {
                # Redireccionar al formulario editar
                redirectToRoute('persona/editar' . $persona_id);
            }
            # Preparar los datos para guardar
            $persona = [
                $persona_id,
                trim($_REQUEST['nro_documento']),
                trim($_REQUEST['nombres']),
                trim($_REQUEST['apellidos']),
                $_REQUEST['fecha_nacimiento'],
                $_REQUEST['genero'],
                $_REQUEST['estado'] ?? ("activo")
            ];
            

            # Actualizar
            $actualizar = Persona::update($persona);
            if ($actualizar) {
                $_SESSION["exito"] = 'El registro ha sigo actualizado.';
                # Redireccionar el gestor
                redirectToRoute('persona/gestor');
            }
            # Enviar al formulario en caso de error al actualizar
            $_SESSION["error400"] = 'Error al actualizar, por favor comuniquese con el administrado.';

            # Redireccionar al formulario editar
            redirectToRoute('persona/editar/' . $persona_id);
        } else {
            error404();
        }
    }

    
    public function eliminar($persona_id) {

            try {

                // Intentar eliminar al usuario
                $eliminar = Persona::delete($persona_id);
    
                if ($eliminar) {
                    // Mensaje de éxito
                    $_SESSION["exito"] = 'El registro ha sido eliminado correctamente.';
                } else {
                    // Mensaje de error en la eliminación
                    $_SESSION["error400"] = 'Error al eliminar, por favor comuníquese con el administrador.';
                }
            } catch (Exception $e) {
                // Capturar cualquier excepción y loguearla
                error_log("Error al eliminar usuario con ID $persona_id: " . $e->getMessage());
                $_SESSION["error400"] = 'Ocurrió un error inesperado. Por favor, inténtelo de nuevo más tarde.';
            }
    
            // Redirigir a la página de gestión de empleados
            //redirectToRoute('empleado/gestor');
            header("Location: ../../../index.php");
        
    }
    
    
}
