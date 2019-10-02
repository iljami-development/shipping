<?php

namespace App\Entity;

class Order
{
    const AVAILABLE_SHIPPING_PROVIDERS = [
        'ups',
        'omniva',
        'dhl'
    ];

    /** @var string */
    private $id;

    /** @var string */
    private $street;

    /** @var string */
    private $postCode;

    /** @var string */
    private $city;

    /** @var string */
    private $country;

    /** @var string */
    private $shippingName;

    /**
     * Get the value of shippingName
     */ 
    public function getShippingName()
    {
        return $this->shippingName;
    }

    /**
     * Set the value of shippingName
     *
     * @return  self
     */ 
    public function setShippingName($shippingName)
    {
        $this->shippingName = $shippingName;

        return $this;
    }

    public function getShipping()
    {
        return 'ups';
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of street
     */ 
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set the value of street
     *
     * @return  self
     */ 
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get the value of postCode
     */ 
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set the value of postCode
     *
     * @return  self
     */ 
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function hasShippingData()
    {
        if (!$this->id)
        {
            return false;
        }

        if (!$this->street)
        {
            return false;
        }

        if (!$this->postCode)
        {
            return false;
        }

        if (!$this->city)
        {
            return false;
        }

        if (!$this->country)
        {
            return false; 
        }

        return true;
    }
}