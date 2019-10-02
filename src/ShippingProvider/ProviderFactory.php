<?php

namespace App\ShippingProvider;

use App\Entity\Order;
use App\ShippingProvider\Dhl;
use App\ShippingProvider\Ups;
use App\ShippingProvider\Omniva;
use App\ShippingProvider\ShippingProviderInterface;

class ProviderFactory
{
    // const UPS_CLASS = "App\ShippingProvider\Ups";
    const UPS_CLASS = Ups::class;
    const OMNIVA_CLASS = Omniva::class;
    const DHL_CLASS = Dhl::class;

    public static function getProvider(Order $order) : ShippingProviderInterface
    {
        if (!$order) {
            throw new \Exception("No order entity has been specified");
        }

        $providers = [
            "ups" => self::UPS_CLASS,
            "omniva" => self::OMNIVA_CLASS,
            "dhl" => self::DHL_CLASS,
        ];

        $providerName = $order->getShippingName();

        //default shipping case
        if (!in_array($providerName, Order::AVAILABLE_SHIPPING_PROVIDERS)) {
            $providerName = $order->getShipping();
        }

        $class = $providers[$providerName];

        if(class_exists($class)) {
            return new $class();
        } else {
            throw new \Exception("Shipping provider class: {$class} does not exist!");
        }
    }
}