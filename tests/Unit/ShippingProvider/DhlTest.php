<?php

namespace App\Tests\Unit\ShippingProvider;

use App\Entity\Order;
use App\ShippingProvider\Dhl;
use PHPUnit\Framework\TestCase;

class DhlTest extends TestCase
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

        $dhl = new Dhl();

        $this->assertTrue($dhl->register($order));
    }
}