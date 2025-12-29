<?php
// Rutas Públicas (ROLE_ANONYMOUS por defecto) 
$router->get('', 'PagesController@index');
$router->get('index.php', 'PagesController@index');
$router->get('about', 'PagesController@about');
$router->get('blog', 'PagesController@blog');
$router->get('post', 'PagesController@post');
$router->get('contact', 'PagesController@contact');

// Rutas de Autenticación
$router->get('login', 'AuthController@login');
$router->post('check-login', 'AuthController@checkLogin');
$router->get('logout', 'AuthController@logout');

// Rutas Protegidas - Solo usuarios registrados (ROLE_USER o ROLE_ADMIN) [cite: 252, 265]
$router->get('galeria', 'GaleriaController@index', 'ROLE_USER');
$router->get('galeria/:id', 'GaleriaController@show', 'ROLE_USER');
$router->get('asociados', 'AsociadosController@index', 'ROLE_USER');

// Rutas Restringidas - Solo Administradores (ROLE_ADMIN) [cite: 250, 267]
$router->post('galeria/nueva', 'GaleriaController@nueva', 'ROLE_ADMIN');
$router->post('asociados', 'AsociadosController@index', 'ROLE_ADMIN');