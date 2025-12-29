<?php
// Rutas GET - PagesController
$router->get('', 'PagesController@index');
$router->get('about', 'PagesController@about');
$router->get('blog', 'PagesController@blog');
$router->get('post', 'PagesController@post');
$router->get('contact', 'PagesController@contact');

// Rutas GET - GaleriaController
$router->get('galeria', 'GaleriaController@index');

// Rutas GET - AsociadosController
$router->get('asociados', 'AsociadosController@index');

// Rutas POST
$router->post('galeria/nueva', 'GaleriaController@nueva');
$router->post('asociados', 'AsociadosController@index');

// PARCHE XAMPP
$router->get('index.php', 'PagesController@index');