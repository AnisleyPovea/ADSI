<div class="card-header">
    <a href="<?= route('persona/crear')?>" class="btn btn-primary">
        Crear persona
</a>
</div>
<div class="card-body">
    
   
</div>

<?php if( isset($_SESSION["exito"]) ) : ?>
    <div class="alert alert-success alert-dismissible">
        <button
        type = "button"
        class = "close"
        data-dismiss = "alert"
        aria-hidden = "true">x</button>

    <h5>
        <i class="icon fas fa-check"></i>
        !Bien Hecho¡
    </h5>
    <?= $_SESSION["exito"]; ?>
</div>
<?php endif; ?>

<?php if ( count($lista_personas) ) : ?>
    <table
    id="dt_personas"
    class="table table-bordered dt-responsive"
    style="width:100%">

    <thead>
        <tr>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Fecha Nacimiento</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lista_personas as $key => $persona) : ?>
            <tr>
                <td><?= $persona->nro_documento ?></td>
                <td><?= $persona->nombre ?></td>
                <td><?= $persona->fecha_nac ?></td>
                <td><?= $persona->estado?></td>
                <td>
                    <div class="btn-space">
                        <a href="<?= route('persona/ver/'.$persona->id) ?>"
                            class="btn btn-success"
                            title="Ver detalle">
                            <i class = "fas fa-eye"></i>
                        </a>
                        <a href="<?= route('persona/editar/'.$persona->id)?>"
                            class="btn btn-primary"
                            title="Editar">
                            <i class="fas fa-edit"> </i>
                        </a>
                        <button
                            class="btn btn-danger btnEliminarPersona"
                            title="Eliminar"
                            value="<?= $persona->id ?>">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
<?php endif ?>