<?php require_once __DIR__ . '/../../templates/inicio.part.php'; ?>
<?php require_once __DIR__ . '/../../templates/navegacion.part.php'; ?>

<div class="hero hero-inner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mx-auto text-center">
                <div class="intro-wrap">
                    <h1 class="mb-0">Nuevo Asociado</h1>
                    <p class="text-white">Registra un nuevo partner para nuestra web.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="asociados">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h2>Datos del asociado:</h2>
            <hr>

            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <div class="alert alert-<?= empty($errores) ? 'info' : 'danger'; ?> alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <?php if (empty($errores)): ?>
                        <p><?= $mensaje ?></p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($errores as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Nombre (Obligatorio)</label>
                        <input type="text" class="form-control" name="nombre" value="<?= $nombre ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Logo (Obligatorio)</label>
                        <input class="form-control-file" type="file" name="logo" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Descripción (Opcional)</label>
                        <textarea class="form-control" name="descripcion"><?= $descripcion ?></textarea>
                        <br>
                        <button class="pull-right btn btn-lg sr-button">GUARDAR ASOCIADO</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../templates/fin.part.php'; ?>