<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use dwes\app\entity\Imagen;

$imagenesClientes = [];
$imagenesClientes[] = new Imagen('client1.jpg', 'MISS BELLA', 0, 0, 0, 0);
$imagenesClientes[] = new Imagen('client2.jpg', 'DON PENO', 0, 0, 0, 0);
$imagenesClientes[] = new Imagen('client3.jpg', 'SWEET MARY', 0, 0, 0, 0);
$imagenesClientes[] = new Imagen('client4.jpg', 'DIVINE STAN', 0, 0, 0, 0);

$vistaPrincipal = __DIR__ . '/../views/galeria.view.php';
require __DIR__ . '/../views/layout.view.php';
?>