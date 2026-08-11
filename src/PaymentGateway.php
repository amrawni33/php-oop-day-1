<?php

namespace App;

interface PaymentGateway
{
    public function pay(float $amount): bool;
}