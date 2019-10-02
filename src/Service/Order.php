<?php

namespace App\Service;

use App\Entity\Order as OrderEntity;
use App\ShippingProvider\ProviderFactory;


class Order
{
    public function registerShipping(OrderEntity $order)
    {
        if (!$order->hasShippingData()) {
            return false;
        }

        $provider = ProviderFactory::getProvider($order);

        return $provider->register($order);
    }
    //true if registration is successful
    //false if not
}