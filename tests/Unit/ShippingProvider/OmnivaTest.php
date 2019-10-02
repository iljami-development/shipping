<?php

namespace App\Tests\Unit\ShippingProvider;

use App\Entity\Order;
use PHPUnit\Framework\TestCase;
use App\ShippingProvider\Omniva;

class OmnivaTest extends TestCase
{
    /**
     * @test
     */
    public function shouldMakeASuccessfullRequestAndReturnTrue()
    {
        $order = new Order();
        $order->setId(999);
        $order->setStreet("Street st. 1");
        $order->setPostCode("7899999");
        $order->setCity("Copenhagen");
        $order->setCountry("Denmark");

        $omniva = new Omniva();

        $this->assertTrue($omniva->register($order));
    }
}