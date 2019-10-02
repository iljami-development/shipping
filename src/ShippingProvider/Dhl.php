<?php

namespace App\ShippingProvider;

use App\Entity\Order;
use Symfony\Component\HttpClient\MockHttpClient;
use App\ShippingProvider\ShippingProviderInterface;
use Symfony\Component\HttpClient\Response\MockResponse;

class Dhl implements ShippingProviderInterface
{
    const REGISTER_URL = "http://dhlfake.com/register";
    const REGISTER_TYPE = [
        "status" => "registered"
    ];
    const STATUS_OK = 200;

    public function register(Order $order) : bool
    {
        if (!$order) {
            throw new \Exception("No order entity has been specified!");
        }

        $client = $this->createApiMock(self::REGISTER_TYPE);

        $query = [
            "order_id" => $order->getId(),
            "country" => $order->getCountry(),
            "address" => $order->getStreet(),
            "town" => $order->getCity(),
            "zip_code" => $order->getPostCode(),
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