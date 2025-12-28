<?php
require_once __DIR__ . '/../../src/entity/imagen.class.php';
require_once __DIR__ . '/../../src/entity/asociado.class.php';
require_once __DIR__ . '/../../src/utils/utils.class.php';

$imagenesHome = [];
for ($i = 1; $i <= 12; $i++) {
    $imagenesHome[] = new Imagen($i . '.jpg', 'descripción imagen ' . $i, 1, 456, 610, 130);
}

$asociados = [];
$asociados[] = new Asociado('First Partner Name', 'log1.jpg', 'Descripción del logo 1');
$asociados[] = new Asociado('Second Partner Name', 'log2.jpg', 'Descripción del logo 2');
$asociados[] = new Asociado('Third Partner Name', 'log3.jpg', 'Descripción del logo 3');

$asociados = Utils::extraeElementosAleatorios($asociados, 3);

require_once __DIR__ . '/../views/index.view.php';
?>