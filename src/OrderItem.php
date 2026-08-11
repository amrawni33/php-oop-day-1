<?php

namespace App;

use InvalidArgumentException, App\Product;

class OrderItem
{

    private Product $product;
    private int $quantity;
    private float $unitPrice;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->unitPrice = $product->getPrice();
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function setQuantity(int $quantity): void
    {
        if ($quantity <= 0) {
            throw new InvalidArgumentException("Quantity cannot be null.");
        }
        $this->quantity = $quantity;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        if ($unitPrice <= 0) {
            throw new InvalidArgumentException("price cannot be zero or less.");
        }
        $this->unitPrice = $unitPrice;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }
    public function getSubtotal(): float
    {
        return $this->quantity * $this->unitPrice;
    }
}
