<?php

namespace App\ShippingProvider;

use App\Entity\Order;

interface ShippingProviderInterface
{
    public function register(Order $order);
}