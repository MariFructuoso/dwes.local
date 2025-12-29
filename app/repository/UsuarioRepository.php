<?php
namespace dwes\app\repository;

use dwes\core\database\QueryBuilder;
use dwes\app\entity\Usuario;

class UsuarioRepository extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct('usuarios', Usuario::class);
    }
}