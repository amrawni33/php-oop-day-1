<?php

namespace App;

class CashPayment implements PaymentGateway
{
    public function pay(float $amount): bool
    {
        return true;
    }
}