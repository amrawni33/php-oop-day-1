<?php

namespace App;

use InvalidArgumentException;

class User
{

    private int $id;
    private string $name;
    private string $email;

    public function __construct(int $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function setId(int $id): void
    {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID must be a positive integer.");
        }
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        if (empty(trim($name))) {
            throw new InvalidArgumentException("Name cannot be empty.");
        }
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format.");
        }
        $this->email = $email;
    }


    //getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
}
