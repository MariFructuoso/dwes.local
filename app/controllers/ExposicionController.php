<?php
namespace dwes\app\controllers;

use dwes\core\App;
use dwes\core\Response;
use dwes\app\repository\ExposicionRepository;
use dwes\app\entity\Exposicion;

class ExposicionController
{
    public function index()
    {
        $exposicionRepository = App::getRepository(ExposicionRepository::class);
        $exposiciones = $exposicionRepository->findAll();
        
        Response::renderView('exposiciones', 'layout', compact('exposiciones'));
    }

    public function create()
    {
        Response::renderView('exposiciones-crear', 'layout');
    }

    public function save()
    {
        try {
            $exposicion = new Exposicion();
            $exposicion->setNombre($_POST['nombre']);
            $exposicion->setDescripcion($_POST['descripcion']);
            $exposicion->setFechaInicio($_POST['fecha_inicio']);
            $exposicion->setFechaFin($_POST['fecha_fin']);
            
            $exposicion->setUsuarioId($_SESSION['loguedUser']); 
            
            $exposicion->setActiva(1); // Por defecto activa

            $repo = App::getRepository(ExposicionRepository::class);
            $repo->save($exposicion);

            App::get('router')->redirect('exposiciones');
            
        } catch (\Exception $e) {
            die("Error al guardar la exposición: " . $e->getMessage());
        }
    }
    
    public function formAnadirImagen($id) 
    {
        $exposicionRepository = App::getRepository(ExposicionRepository::class);
        $exposiciones = $exposicionRepository->findAll();
        
        $idImagen = $id; 
        
        Response::renderView('exposicion-anadir-imagen', 'layout', compact('exposiciones', 'idImagen'));
    }

    public function saveImagenExposicion()
    {
        try {
            $idImagen = $_POST['id_imagen'];
            $idExposicion = $_POST['id_exposicion'];
            
            $repo = App::getRepository(ExposicionRepository::class);
            /** @var ExposicionRepository $repo */
            $repo->guardarRelacionImagen($idImagen, $idExposicion);
            
            App::get('router')->redirect('galeria');
        } catch (\Exception $e) {
             die("Error al añadir imagen a expo: " . $e->getMessage());
        }
    }
}