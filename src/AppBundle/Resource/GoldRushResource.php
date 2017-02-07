<?php

namespace AppBundle\Resource;


class GoldRushResource
{
    /**
     * @var float
     */
    private $exchangeRate;

    /**
     * @var string
     */
    private $exchangeDate;

    /**
     * GoldDetailsResource constructor.
     * @param float $exchangeRate
     * @param string $exchangeDate
     */
    public function __construct($exchangeRate, $exchangeDate)
    {
        $this->exchangeRate = $exchangeRate;
        $this->exchangeDate = $exchangeDate;
    }

    /**
     * @return float
     */
    public function getExchangeRate()
    {
        return (float)$this->exchangeRate;
    }

    /**
     * @return string
     */
    public function getExchangeDate()
    {
        return $this->exchangeDate;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'exchangeRate' => (float)$this->exchangeRate,
            'exchangeDate' => $this->exchangeDate
        ];
    }

}