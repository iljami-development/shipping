<?php


namespace App\Tests\Unit\Entity;

use App\Entity\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldHaveUpsAsDefaultShipping()
    {
        $order = new Order();

        $this->assertEquals('ups', $order->getShipping());
    }

    /**
     * @test
     */
    public function shouldSetAndGetId()
    {
        $order = new Order();
        $order->setId(20);

        $this->assertEquals(20, $order->getId());
    }

    /**
     * @test
     */
    public function shouldSetAndGetStreet()
    {
        $order = new Order();
        $order->setStreet("Oxford st.");

        $this->assertEquals("Oxford st.", $order->getStreet());
    }

    /**
     * @test
     */
    public function shouldSetAndGetPostCode()
    {
        $order = new Order();
        $order->setPostCode("199878978");

        $this->assertEquals("199878978", $order->getPostCode());
    }

    /**
     * @test
     */
    public function shouldSetAndGetCity()
    {
        $order = new Order();
        $order->setCity("Campbridge");

        $this->assertEquals("Campbridge", $order->getCity());
    }

    /**
     * @test
     */
    public function shouldSetAndGetCountry()
    {
        $order = new Order();
        $order->setCountry("England");

        $this->assertEquals("England", $order->getCountry());
    }

    /**
     * @test
     */
    public function shouldSetAndGetShippingName()
    {
        $order = new Order();
        $order->setShippingName("dhl");

        $this->assertEquals("dhl", $order->getShippingName());
    }

    /**
     * @test
     */
    public function shouldReturnFalseIfShippingInfoIsNotFullySet()
    {
        $order = new Order();

        $order->setPostCode("111552");
        $order->setCity("Warsaw");
        $order->setCountry("Poland");

        $this->assertFalse($order->hasShippingData());
    }

    /**
     * @test
     */
    public function shouldReturnTrueIfShippingInfoIsFullySet()
    {
        $order = new Order();

        $order->setId(999);
        $order->setPostCode("111552");
        $order->setCity("Warsaw");
        $order->setCountry("Poland");
        $order->setStreet("Random st. 99");

        $this->assertTrue($order->hasShippingData());
    }

    /**
     * @test
     */
    public function shouldReturnFalseIfShippingInfoIsNotSet()
    {
        $order = new Order();

        $this->assertFalse($order->hasShippingData());
    }
}