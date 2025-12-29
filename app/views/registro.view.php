<div id="registro">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>Registro de Usuario</h1>
            <hr>
            <?php include __DIR__ . '/show-error.part.view.php' ?>
            
            <?php if(isset($mensaje)): ?>
                <div class="alert alert-success"><?= $mensaje ?></div>
            <?php endif; ?>

            <form class="form-horizontal" action="/check-registro" method="post">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Username</label>
                        <input class="form-control" type="text" name="username" value="<?= $username ?? '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Password</label>
                        <input class="form-control" name="password" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Repite el Password</label>
                        <input class="form-control" name="re-password" type="password">
                        <br>
                        <button class="pull-right btn btn-lg sr-button">REGISTRAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>