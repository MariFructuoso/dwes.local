<?php
// Recorremos el array de clientes que hemos creado en about.php
foreach ($imagenesClientes as $cliente): ?>
    <div class="col-xs-12 col-sm-3">
        <img class="img-responsive" src="<?php echo $cliente->getUrlClientes(); ?>" alt="client's picture">
        <h5><?php echo $cliente->getDescripcion(); ?></h5> <q>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</q>
    </div>
<?php endforeach; ?>