<?php
// Rutas GET (lectura)

// 1. Rutas que ahora gestiona el PagesController (Según paso 2 del PDF)
$router->get('', 'PagesController@index');
$router->get('about', 'PagesController@about');
$router->get('blog', 'PagesController@blog');
$router->get('post', 'PagesController@post');

// 2. Rutas que siguen funcionando con archivos "antiguos" (hasta próximos pasos)
$router->get('asociados', 'app/controllers/asociados.php');
$router->get('contact', 'app/controllers/contact.php');
$router->get('galeria', 'app/controllers/galeria.php');

// Rutas POST (guardar datos)
$router->post('galeria/nueva', 'app/controllers/galeria_nueva.php'); 
$router->post('asociados', 'app/controllers/asociados.php');

// PARCHE XAMPP 
$router->get('index.php', 'PagesController@index'); // Actualizado también para usar el controlador