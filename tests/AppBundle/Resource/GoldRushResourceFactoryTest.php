<?php

namespace Tests\AppBundle\Resource;

use AppBundle\Resource\GoldRushResource;
use AppBundle\Resource\GoldRushResourceFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class GoldRushResourceFactoryTest
 * @package Tests\AppBundle\Resource
 */
class GoldRushResourceFactoryTest extends TestCase
{

    /**
     * @test
     */
    public function testShouldInitialize()
    {
        new GoldRushResourceFactory();
    }

    /**
     * @test
     */
    public function testShouldBuildGoldRushResource()
    {
        $goldRushResourceFactory = new GoldRushResourceFactory();

        $rawData = new \stdClass();
        $rawData->cena = 123.44;
        $rawData->data = '2017-01-23';

        $goldRushResource = $goldRushResourceFactory->buildGoldRushResource($rawData);
        $expectedGoldRushResource = new GoldRushResource(123.44,'2017-01-23');

        self::assertEquals($expectedGoldRushResource->getExchangeRate(), $goldRushResource->getExchangeRate());
        self::assertEquals($expectedGoldRushResource->getExchangeDate(), $goldRushResource->getExchangeDate());
        self::assertArrayHasKey('exchangeRate', $goldRushResource->toArray());
        self::assertArrayHasKey('exchangeDate', $goldRushResource->toArray());
        self::assertEquals($expectedGoldRushResource->getExchangeRate(), $goldRushResource->toArray()['exchangeRate']);
        self::assertEquals($expectedGoldRushResource->getExchangeDate(), $goldRushResource->toArray()['exchangeDate']);

    }

    /**
     * @test
     */
    public function testShouldBuildGoldRushResourceCollection()
    {
        $goldRushResourceFactory = new GoldRushResourceFactory();

        $rawData = new \stdClass();
        $rawData->cena = 123.44;
        $rawData->data = '2017-01-23';

        $rawDataCollection = [
            $rawData,
        ];

        $goldRushResourceCollection = $goldRushResourceFactory->buildGoldRushResourceCollection($rawDataCollection);
        $goldRushResourceItems = $goldRushResourceCollection->getIterator();
        $goldRushResource = $goldRushResourceItems[0];

        $expectedGoldRushResource = new GoldRushResource(123.44,'2017-01-23');

        self::assertEquals($expectedGoldRushResource->getExchangeRate(), $goldRushResource->getExchangeRate());
        self::assertEquals($expectedGoldRushResource->getExchangeDate(), $goldRushResource->getExchangeDate());
        self::assertArrayHasKey('exchangeRate', $goldRushResource->toArray());
        self::assertArrayHasKey('exchangeDate', $goldRushResource->toArray());
        self::assertEquals($expectedGoldRushResource->getExchangeRate(), $goldRushResource->toArray()['exchangeRate']);
        self::assertEquals($expectedGoldRushResource->getExchangeDate(), $goldRushResource->toArray()['exchangeDate']);
    }

}