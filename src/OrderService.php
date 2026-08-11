<?php

namespace App;

use LogicException;

class OrderService
{
    // إنشاء طلب جديد
    public function createOrder(User $customer, array $items = []): Order
    {
        return new Order(null, $customer, $items);
    }

    // حساب الإجمالي
    public function calculateTotal(Order $order): float
    {
        $total = 0.0;
        foreach ($order->getItems() as $item) {
            $total += $item->getSubtotal();
        }
        return $total;
    }

    // تأكيد الطلب
    public function confirmOrder(Order $order): void
    {
        if ($order->getStatus() === OrderStatus::CANCELLED) {
            throw new LogicException("Cannot confirm a cancelled order.");
        }

        if (empty($order->getItems())) {
            throw new LogicException("Cannot confirm an empty order.");
        }

        $order->setStatus(OrderStatus::CONFIRMED);
    }

    // إلغاء الطلب
    public function cancelOrder(Order $order): void
    {
        if ($order->getStatus() === OrderStatus::CONFIRMED) {
            throw new LogicException("Cannot cancel an already confirmed order.");
        }

        $order->setStatus(OrderStatus::CANCELLED);
    }

    public function processPayment(Order $order, PaymentGateway $paymentGateway): bool
    {
        $amount = $this->calculateTotal($order);
        
        $isPaid = $paymentGateway->pay($amount);

        if ($isPaid) {
            $this->confirmOrder($order);
        }

        return $isPaid;
    }
}