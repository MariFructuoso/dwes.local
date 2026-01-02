<div class="hero hero-inner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mx-auto text-center">
                <div class="intro-wrap">
                    <h1 class="mb-0">Galería</h1>
                    <p class="text-white">Nuestros viajeros comparten aquí sus mejores experiencias.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="galeria">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h2>Subir imágenes:</h2>
            <hr>

            <?php include __DIR__ . '/show-error.part.view.php'; ?>

            <form class="form-horizontal" action="/galeria/nueva" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Imagen</label>
                        <input class="form-control-file" type="file" name="imagen">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Categoria</label>
                        <select class="form-control" name="categoria">
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria->getId() ?>"
                                    <?= ($categoriaSeleccionada == $categoria->getId()) ? 'selected' : '' ?>>
                                    <?= $categoria->getNombre() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Titulo</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $titulo ?> ">
                        <label class="label-control">Descripción</label>
                        <textarea class="form-control" name="descripcion"><?= $descripcion ?></textarea>
                        <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                    </div>
                </div>
            </form>

            <hr class="divider">

            <div class="imagenes_galeria">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($imagenes as $imagen): ?>
                            <tr>
                                <th scope="row">
                                    <a href="/galeria/<?= $imagen->getId() ?>">
                                        <?= $imagen->getNombre() ?>
                                    </a>
                                </th>
                                <td>
                                    <img src="<?= $imagen->getUrlSubidas() ?>"
                                        alt="<?= $imagen->getDescripcion() ?>"
                                        width="100px">
                                </td>
                                <td><?= $imagenesRepository->getCategoria($imagen)->getNombre() ?></td>

                                <td>
                                    <a href="/galeria/borrar/<?= $imagen->getId() ?>"
                                        class="btn btn-danger btn-xs"
                                        onclick="return confirm('¿Seguro que quieres borrar esta imagen?')">
                                        <i class="fa fa-trash"></i> Borrar
                                    </a>

                                    <a href="/exposicion/anadirimagen/<?= $imagen->getId() ?>"
                                        class="btn btn-info btn-xs">
                                        <i class="fa fa-plus"></i> Añadir a Exposición
                                    </a>
                                </td>
                                <td>
                                    <a href="/galeria/editar/<?= $imagen->getId() ?>" class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i> Editar
                                    </a>

                                    <a href="/galeria/borrar/<?= $imagen->getId() ?>"
                                        class="btn btn-danger btn-xs"
                                        onclick="return confirm('¿Seguro?')">
                                        <i class="fa fa-trash"></i> Borrar
                                    </a>

                                    <a href="/exposicion/anadirimagen/<?= $imagen->getId() ?>" class="btn btn-info btn-xs">
                                        <i class="fa fa-plus"></i> Expo
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>