<?php


namespace App\Tests\Unit\ShippingProvider;

use App\Service\Order;
use PHPUnit\Framework\TestCase;
use App\Entity\Order as OrderEntity;

class OrderTest extends TestCase
{
    function prepareEntity()
    {
        $order = new OrderEntity();

        $order->setId(999);
        $order->setStreet("Street st. 1");
        $order->setPostCode("7899999");
        $order->setCity("Copenhagen");
        $order->setCountry("Denmark");
        
        return $order;
    }

    /**
     * @test
     */
    public function shouldReturnTrueIfShippingSuccessfullyRegistered()
    {
        $order = $this->prepareEntity();
        $order->setShippingName("Omniva");

        $orderService = new Order();

        $this->assertTrue($orderService->registerShipping($order));
    }

    /**
     * @test
     */
    public function shouldReturnTrueWithoutAnyShippingProviderSet()
    {
        $order = $this->prepareEntity();

        $orderService = new Order();

        $this->assertTrue($orderService->registerShipping($order));
    }

    /**
     * @test
     */
    public function shouldReturnTrueAllShippingDataIsSet()
    {
        $order = $this->prepareEntity();

        $orderService = new Order();

        $this->assertTrue($orderService->registerShipping($order));
    }

    /**
     * @test
     */
    public function shouldReturnFalseNotAllShippingDataIsSet()
    {
        $order = new OrderEntity();
        $order->setStreet("Saint George st.");

        $orderService = new Order();

        $this->assertFalse($orderService->registerShipping($order));
    }

    /**
     * @test
     */
    public function shouldReturnFalseNoShippingDataIsSet()
    {
        $order = new OrderEntity();

        $orderService = new Order();

        $this->assertFalse($orderService->registerShipping($order));
    }
}    