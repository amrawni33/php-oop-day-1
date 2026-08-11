<?php

namespace App;

use InvalidArgumentException;

class Product
{

    private int $id;
    private string $name;
    private float $price;
    private int $stock;


    public function __construct(int $id, string $name, float $price, int $stock)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
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

    public function setPrice(float $price): void
    {
        if ($price <= 0) {
            throw new InvalidArgumentException("price cannot be zero or less.");
        }
        $this->price = $price;
    }

    public function setStock(int $stock): void
    {
        if ($stock < 0) {
            throw new InvalidArgumentException("Stock cannot be null.");
        }
        $this->stock = $stock;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getStock(): int
    {
        return $this->stock;
    }
}
