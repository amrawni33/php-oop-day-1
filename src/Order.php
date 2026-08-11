<?php

namespace App;

class Order
{
    private ?int $id;
    private User $customer;

    /** @var OrderItem[] */
    private array $items = [];

    private OrderStatus $status;

    public function __construct(?int $id, User $customer, array $items = []) 
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->status = OrderStatus::PENDING;

        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    public function addItem(OrderItem $item): void
    {
        $this->items[] = $item;
    }

    public function removeItem(OrderItem $itemToRemove): void
    {
        $this->items = array_values(array_filter(
            $this->items,
            fn(OrderItem $item) => $item !== $itemToRemove
        ));
    }

    // Getters & Setters
    public function getId(): ?int { return $this->id; }
    public function getCustomer(): User { return $this->customer; }
    public function getItems(): array { return $this->items; }
    public function getStatus(): OrderStatus { return $this->status; }
    public function setStatus(OrderStatus $status): void { $this->status = $status; }
    public function getUser(): User { return $this->customer; }
}