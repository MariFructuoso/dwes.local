<?php
namespace dwes\app\entity;

use dwes\app\entity\IEntity;

class Usuario implements IEntity
{
    private $id;
    private $username;
    private $password;
    private $role;

    public function getId() { return $this->id; }
    
    public function getUsername() { return $this->username; }
    public function setUsername($username) { $this->username = $username; }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }

    public function getRole() { return $this->role; }
    public function setRole($role) { $this->role = $role; }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'role' => $this->role
        ];
    }

    public function __toString()
    {
        return $this->username;
    }
}