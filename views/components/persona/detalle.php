<div class="card-body">
    <h5>Datos de la persona</h5>
    <div class="row"> <!-- Fila 1 -->
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nro documento</label>
                <input type="text" class="form-control" value="<?= $persona->nro_documento ?? ' ' ?>" disabled>
            </div>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
    <div class="row"> <!-- Fila 2 -->
        <div class="col-sm-6">
            <label>Apellidos</label>
            <input type="text" class="form-control" value="<?= $persona->apellidos ?? ' ' ?>" disabled>
        </div>
        <div class="col-sm-6">
            <label>Nombres</label>
            <input type="text" class="form-control" value="<?= $persona->nombres ?? ' ' ?>" disabled>
        </div>
    </div>
    <div class="row"> <!-- Fila 3 -->
        <div class="col-sm-6">
            <label>Genero</label>
            <input type="text" class="form-control" value="<?= $persona->genero ?? ' ' ?>" disabled>
        </div>
        <div class="col-sm-6">
            <label>Fecha de nacimiento</label>
            <input type="text" class="form-control" value="<?= $persona->fecha_nacimiento ?? ' ' ?>" disabled>
        </div>
    </div>
</div>