<?php

namespace Tests\AppBundle\Resource;

use AppBundle\Resource\GoldRushResource;
use PHPUnit\Framework\TestCase;

/**
 * Class GoldRushResourceTest
 * @package Tests\AppBundle\Resource
 */
class GoldRushResourceTest extends TestCase
{

    /**
     * @test
     */
    public function testGoldRushResourceInitialize()
    {
        new GoldRushResource(123.44, '2017-01-23');
    }

    /**
     * @test
     */
    public function testGoldRushResource()
    {
        $goldRushResource = new GoldRushResource(123.44,'2017-01-23');

        $expectedRate = 123.44;
        $expectedDate = '2017-01-23';


        self::assertEquals($expectedRate, $goldRushResource->getExchangeRate());
        self::assertEquals($expectedDate, $goldRushResource->getExchangeDate());
        self::assertArrayHasKey('exchangeRate', $goldRushResource->toArray());
        self::assertArrayHasKey('exchangeDate', $goldRushResource->toArray());
        self::assertEquals($expectedRate, $goldRushResource->toArray()['exchangeRate']);
        self::assertEquals($expectedDate, $goldRushResource->toArray()['exchangeDate']);
    }
}