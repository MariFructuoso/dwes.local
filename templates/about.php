<?php
// 1. Cargar la clase Imagen
require_once __DIR__ . '/../src/entity/imagen.class.php';

// 2. Crear el array con los 4 clientes
$imagenesClientes = [];
$imagenesClientes[] = new Imagen('client1.jpg', 'MISS BELLA', 0, 0, 0, 0);
$imagenesClientes[] = new Imagen('client2.jpg', 'DON PENO', 0, 0, 0, 0);
$imagenesClientes[] = new Imagen('client3.jpg', 'SWEET MARY', 0, 0, 0, 0);
$imagenesClientes[] = new Imagen('client4.jpg', 'DIVINE STAN', 0, 0, 0, 0);

// 3. Cargar la vista (que ahora tiene acceso a $imagenesClientes)
require_once __DIR__ . '/views/about.view.php';
?>