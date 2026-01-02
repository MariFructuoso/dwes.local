<?php

// Rutas Públicas
$router->get('', 'PagesController@index');
$router->get('index.php', 'PagesController@index');
$router->get('about', 'PagesController@about');
$router->get('blog', 'PagesController@blog');
$router->get('post', 'PagesController@post');
$router->get('contact', 'PagesController@contact');

// Autenticación
$router->get('login', 'AuthController@login');
$router->post('check-login', 'AuthController@checkLogin');
$router->get('logout', 'AuthController@logout');
$router->get('registro', 'AuthController@registro');
$router->post('check-registro', 'AuthController@checkRegistro');

// --- GALERÍA ---
// Listado principal
$router->get('galeria', 'GaleriaController@index', 'ROLE_USER');

// CORRECCIÓN: Usamos :id en lugar de (\d+)
$router->get('galeria/:id', 'GaleriaController@show', 'ROLE_USER');
$router->get('galeria/borrar/:id', 'GaleriaController@borrar', 'ROLE_USER');
$router->post('galeria/nueva', 'GaleriaController@nueva', 'ROLE_USER');

// --- EXPOSICIONES ---
$router->get('exposiciones', 'ExposicionController@index', 'ROLE_USER');
$router->get('exposiciones/nueva', 'ExposicionController@create', 'ROLE_USER');
$router->post('exposiciones/guardar', 'ExposicionController@save', 'ROLE_USER');

// CORRECCIÓN: Usamos :id aquí también
$router->get('exposicion/anadirimagen/:id', 'ExposicionController@formAnadirImagen', 'ROLE_USER');
$router->post('exposicion/anadirimagen/guardar', 'ExposicionController@saveImagenExposicion', 'ROLE_USER');

// Asociados
$router->get('asociados', 'AsociadosController@index', 'ROLE_USER');
$router->post('asociados', 'AsociadosController@index', 'ROLE_ADMIN');

$router->get('galeria/editar/:id', 'GaleriaController@editar', 'ROLE_USER');
$router->post('galeria/update', 'GaleriaController@update', 'ROLE_USER');