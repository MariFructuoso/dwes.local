<?php
namespace dwes\app\entity;

use dwes\app\entity\IEntity;

class Usuario implements IEntity
{
    private $id;
    private $username;
    private $password;
    private $role;

    public function getId(): ?int 
    { 
        return $this->id; 
    }
    
    public function getUsername(): string 
    { 
        return $this->username; 
    }
    
    public function setUsername(string $username): void 
    { 
        $this->username = $username; 
    }

    public function getPassword(): string 
    { 
        return $this->password; 
    }
    
    public function setPassword(string $password): void 
    { 
        $this->password = $password; 
    }

    public function getRole(): string 
    { 
        return $this->role; 
    }
    
    public function setRole(string $role): void 
    { 
        $this->role = $role; 
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'role' => $this->role
        ];
    }

    public function __toString(): string
    {
        return $this->username;
    }
}