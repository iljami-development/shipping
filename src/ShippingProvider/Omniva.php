<?php

namespace App\ShippingProvider;

use App\Entity\Order;
use Symfony\Component\HttpClient\MockHttpClient;
use App\ShippingProvider\ShippingProviderInterface;
use Symfony\Component\HttpClient\Response\MockResponse;

class Omniva implements ShippingProviderInterface
{
    const PICKUP_URL = "http://omnivafake.com/pickup/find";
    const REGISTER_URL = "http://omnivafake.com/register";
    const PICKUP_TYPE = [
        "pick_up_point_id" => "9988776655"
    ];
    const REGISTER_TYPE = [
        "status" => "registered"
    ];
    const STATUS_OK = 200;


    public function register(Order $order) : bool
    {   
        if (!$order) {
            throw new \Exception("No order entity has been specified!");
        }

        $pickUpPointId = $this->getPickUpPointId($order);
 
        $client = $this->createApiMock(self::REGISTER_TYPE);

        $query = [
            "pick_up_point_id" => $pickUpPointId,
            "order_id" => $order->getId(),
        ];

        $response = $client->request("GET", self::REGISTER_URL, ["query" => $query]);

        $response = $this->handleResponse($response);

        if (!$response || !array_key_exists('status', $response))
        {
            return false;
        }

        if ($response["status"] === self::REGISTER_TYPE["status"])
        {
            return true;
        }

        return false;
    }

    private function createApiMock(Array $info) : MockHttpClient
    {
        if (!$info) {
            $info = self::REGISTER_TYPE;
        }

        $body = "";

        $responses = [
            new MockResponse($body, $info),
        ];

        return new MockHttpClient($responses);
    }

    private function getPickUpPointId(Order $order)
    {
        if (!$order) {
            throw new \Exception("No order entity has been specified!");
        }

        $client = $this->createApiMock(self::PICKUP_TYPE);

        $query = [
            "country" => $order->getCountry(),
            "post_code" => $order->getPostCode(),
        ];
        
        $response = $client->request("GET", self::PICKUP_URL, ["query" => $query]);

        $response = $this->handleResponse($response);

        if (!$response || !array_key_exists('pick_up_point_id', $response))
        {
            return false;
        }

        return $response['pick_up_point_id'];
    }

    private function handleResponse(MockResponse $response)
    {
        if (!$response) {
            throw new \Exception("No response object has been specified!");
        }

        if ($response->getStatusCode() === self::STATUS_OK)
        {
            return $response->getInfo();
        }

        return false;
    }
}