<?php

namespace App\Tests\Unit\ShippingProvider;

use App\Entity\Order;
use App\ShippingProvider\Ups;
use PHPUnit\Framework\TestCase;
use App\ShippingProvider\Omniva;
use App\ShippingProvider\ProviderFactory;
use App\ShippingProvider\ShippingProviderInterface;

class ProviderFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnInstanceOfShippingProviderInterface()
    {
        $order = new Order();

        $provider = ProviderFactory::getProvider($order);

        $this->assertInstanceOf(ShippingProviderInterface::class, $provider);
    }

    /**
     * @test
     */
    public function shouldReturnUpsClassWhenNoShippingNameIsSpecified()
    {
        $order = new Order();

        $provider = ProviderFactory::getProvider($order);

        $this->assertInstanceOf(Ups::class, $provider);
    }

    /**
     * @test
     */
    public function shouldReturnOmnivaClass()
    {
        $order = new Order();
        $order->setShippingName("omniva");

        $provider = ProviderFactory::getProvider($order);

        $this->assertInstanceOf(Omniva::class, $provider);
    }

    /**
     * @test
     */
    public function shouldReturnUpsClassWhenNotAvailableShippingNameIsSet()
    {
        $order = new Order();
        $order->setShippingName("royal_post");

        $provider = ProviderFactory::getProvider($order);

        $this->assertInstanceOf(Ups::class, $provider);
    }

}