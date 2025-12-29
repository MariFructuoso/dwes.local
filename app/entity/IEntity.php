<?php
namespace dwes\app\entity;

interface IEntity
{
    public function getId();
    public function toArray(): array;
}
?>