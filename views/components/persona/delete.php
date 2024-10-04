<?php
require $_SERVER['DOCUMENT_ROOT'] . '/adsi/controllers/PersonaController.php';



$PersonaController = new PersonaController;

if (isset($_GET['id'])) {
    $persona_id = $_GET['id'];

    $PersonaController->eliminar($persona_id);
}
