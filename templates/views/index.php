<?php
// 1. Cargamos la clase Imagen (ajustando la ruta a src)
require_once __DIR__ . '/../src/entity/imagen.class.php';

// 2. Creamos el array de imágenes como pide el PDF
$imagenesHome = [];

// Generamos 12 imágenes (1.jpg, 2.jpg... hasta 12.jpg)
for ($i = 1; $i <= 12; $i++) {
    $imagenesHome[] = new Imagen(
        $i . '.jpg',               // Nombre archivo
        'descripción imagen ' . $i, // Descripción
        1,                         // Categoría
        456,                       // Visualizaciones (ejemplo PDF)
        610,                       // Likes (ejemplo PDF)
        130                        // Downloads (ejemplo PDF)
    );
}

require_once __DIR__ . '/views/index.view.php';
?>