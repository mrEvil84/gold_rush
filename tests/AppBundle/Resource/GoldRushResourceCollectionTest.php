<?php

namespace Tests\AppBundle\Resource;

use AppBundle\Resource\GoldRushResource;
use AppBundle\Resource\GoldRushResourceCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class GoldRushResourceCollection
 * @package Tests\AppBundle\Resource
 */
class GoldRushResourceCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function testShouldInitialize()
    {
        new GoldRushResourceCollection();
    }

    /**
     * @test
     */
    public function testResourceCollectionTest()
    {
        $goldRushResourceCollection = new GoldRushResourceCollection();
        $goldRushResourceCollection->addItem(new GoldRushResource(123.44, '2017-02-07'));
        $goldRushResourceItems = $goldRushResourceCollection->getIterator();
        $goldRushResource = $goldRushResourceItems[0];

        $expectedRate = 123.44;
        $expectedDate = '2017-02-07';

        self::assertEquals($expectedRate, $goldRushResource->getExchangeRate());
        self::assertEquals($expectedDate, $goldRushResource->getExchangeDate());
        self::assertArrayHasKey('exchangeRate', $goldRushResource->toArray());
        self::assertArrayHasKey('exchangeDate', $goldRushResource->toArray());
        self::assertEquals($expectedRate, $goldRushResource->toArray()['exchangeRate']);
        self::assertEquals($expectedDate, $goldRushResource->toArray()['exchangeDate']);


    }

}