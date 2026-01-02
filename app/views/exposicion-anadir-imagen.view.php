<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Añadir imagen a una Exposición</h3>
                </div>
                <div class="panel-body">
                    <form action="/exposicion/anadirimagen/guardar" method="POST">
                        
                        <input type="hidden" name="id_imagen" value="<?= $idImagen ?>">

                        <div class="form-group">
                            <label>Selecciona la Exposición:</label>
                            <select name="id_exposicion" class="form-control" required>
                                <?php if(empty($exposiciones)): ?>
                                    <option value="" disabled selected>No hay exposiciones disponibles</option>
                                <?php else: ?>
                                    <?php foreach ($exposiciones as $expo): ?>
                                        <?php if($expo->getActiva()): ?>
                                            <option value="<?= $expo->getId() ?>">
                                                <?= $expo->getNombre() ?> (<?= $expo->getFechaInicio() ?>)
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group text-center mt-4" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i> Añadir a la Exposición
                            </button>
                            <a href="/galeria" class="btn btn-default">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>