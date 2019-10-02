<?php

namespace App\Tests\Unit\ShippingProvider;

use App\Entity\Order;
use App\ShippingProvider\Ups;
use PHPUnit\Framework\TestCase;

class UpsTest extends TestCase
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

        $ups = new Ups();

        $this->assertTrue($ups->register($order));
    }
}