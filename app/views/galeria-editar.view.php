<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Editar Imagen</h2>
            <hr>
            <form class="form-horizontal" action="/galeria/update" method="post">
                <input type="hidden" name="id" value="<?= $imagen->getId() ?>">

                <div class="form-group">
                    <label class="label-control">Título</label>
                    <input type="text" class="form-control" name="titulo" value="<?= $imagen->getNombre() ?>" required>
                </div>

                <div class="form-group">
                    <label class="label-control">Categoría</label>
                    <select class="form-control" name="categoria">
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria->getId() ?>"
                                <?= ($imagen->getCategoria() == $categoria->getId()) ? 'selected' : '' ?>>
                                <?= $categoria->getNombre() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="label-control">Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="4"><?= $imagen->getDescripcion() ?></textarea>
                </div>
                
                <div class="form-group mt-3">
                    <label>Imagen actual:</label><br>
                    <img src="<?= $imagen->getUrlSubidas() ?>" width="150">
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="/galeria" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>