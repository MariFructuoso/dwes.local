<?php

namespace dwes\app\controllers;

use dwes\app\entity\Imagen;
use dwes\app\entity\Asociado;
use dwes\core\Response; 

class PagesController
{
    public function index()
    {
        $imagenesHome = [];
        for ($i = 1; $i <= 12; $i++) {
            $imagenesHome[] = new Imagen($i . '.jpg', 'descripción imagen ' . $i, 1, 456, 610, 130);
        }

        $asociadosLista = [];
        $asociadosLista = [];
        $asociadosLista[] = new Asociado("PhotoStyle, S.L.", "log1.jpg", "First Partner Photo Style");
        $asociadosLista[] = new Asociado("Second Partner Name", "log2.jpg", "Descripción del logo 2");
        $asociadosLista[] = new Asociado("Third Partner Name", "log3.jpg", "Descripción del logo 3");

        return Response::renderView(
            'index',
            'layout',
            compact('imagenesHome', 'asociadosLista')
        );
    }

    public function about()
    {
        $imagenesClientes = [];
        $imagenesClientes[] = new Imagen('client1.jpg', 'MISS BELLA', 0, 0, 0, 0);
        $imagenesClientes[] = new Imagen('client2.jpg', 'DON LUIS', 0, 0, 0, 0);
        $imagenesClientes[] = new Imagen('client3.jpg', 'MISS ARABELLA', 0, 0, 0, 0);
        $imagenesClientes[] = new Imagen('client4.jpg', 'DON LORENZO', 0, 0, 0, 0);

        return Response::renderView(
            'about',
            'layout',
            compact('imagenesClientes')
        );
    }

    public function blog()
    {
        return Response::renderView('blog', 'layout');
    }

    public function post()
    {
        return Response::renderView('single_post', 'layout');
    }

    public function contact()
    {
        return Response::renderView('contact', 'layout-with-footer');
    }
}