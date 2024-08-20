<div class="card-body">
<!-- Error de solicitud incorrecta -->
<?php if ( isset($_SESSION["error400"]) ) : ?>
<div class="alert alert-danger alert-dismissible">
<button
type="button"
class="close"
data-dismiss="alert"
aria-hidden="true">x</button>
<h5>
<i class="icon fas fa-ban"></i>
Error
</h5>
<?php $_SESSION["error400"]; ?>
</div>

<?php endif; ?>


<!-- Formulario utilizado para registrar y editar los datos de la persona -->
<form action="<?= isset($persona) ? route('persona/actualizar') : route('persona/guardar') ?>"
method="POST">
    <?php if ( isset($persona) ) : ?>
        <input type="hidden" name="usuario_id" value="<?= $persona->id ?? '' ?>">
    <?php endif ?>

<div class="row"> <!-- Fila 1 del formulario -->
    <div class="col-sm-6"> <!-- Celda 1 de la fila 1 -->
        <div class="form-group">
        <label>Documento de identidad<span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="nro_documento"
        value="<?= $persona->nro_documento ?? '' ?>"
        placeholder="Ingresa el documento de identidad">

        <?= errorMessage('nro_documento') ?>


            </div>
        <div></div>
    </div>
    <div></div> <!-- Celda 2 de la fila 1 - no contiene campos-->
</div>
<div class="row"> <!-- Fila 2 del formulario -->
    <div class="col-sm-6"> <!-- Celda 1 de la fila 2 -->
        <div class="form-group">
        <label>Nombres <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="nombres"
        value="<?= $persona->nombres ?? '' ?>"
        placeholder="Ingresa los nombres">

        <?= errorMessage('nombres'); ?>
        </div>
    </div>
    <div class="col-sm-6"> <!-- Celda 2 de la fila 2 -->
        <div class="form-group">
        <label>Apellidos <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="apellidos"
        value="<?= $persona->apellidos ?? '' ?>"
        placeholder="Ingresa los apellidos">

        <?= errorMessage('apellidos') ?>
        </div>
    </div>
</div>


    <div class="row"> <!-- Fila 3 del formulario -->
        <div class="col-sm-6"> <!-- Celda 1 de la fila 3 -->
            <div class="form-group">
                <label>Genero <span class=text-danger>*</span></label>
                    <select class="custom-select" name="genero">
                         <option value="">Seleccione</option>
                        <?php foreach ( generos() as $genero ): ?>
                        <option value="<?= $genero ?>">
                    <?= isset($persona) && $persona->genero == $genero ? 'selected' : '' ?>
                <?= $genero ?>
            </option>
                        <?php endforeach ?>
                    </select>
                    <?= errorMessage('genero') ?>
            </div>
        </div>
    <div class="col-sm-6"> <!-- Celda 2 de la fila 3 -->

    <div class="form-group">
        <label>
        Fecha de nacimiento
        </label>
<input type="date" class="form-control" name="fecha_nacimiento"
value="<?= $persona->fecha_nacimiento ?? '' ?>">
<?= errorMessage('fecha_nacimiento') ?>
    </div>
</div>
</div>
<button type="submit" class="btn btn-primary">
<?= isset($persona) ? 'Actualizar' : 'Guardar' ?> Persona
</button>
</form>
</div>

