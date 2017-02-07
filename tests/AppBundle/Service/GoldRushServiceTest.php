<?php

namespace Tests\AppBundle\Service;

use AppBundle\DTO\GoldRushDTO;
use AppBundle\Repository\GoldRushRepository;
use AppBundle\Resource\GoldRushResourceFactory;
use AppBundle\Service\GoldRushService;
use DateInterval;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Class GoldRushServiceTest
 * @package Tests\AppBundle\Service
 */
class GoldRushServiceTest extends TestCase
{
    const DATE_FORMAT = 'Y-m-d';

    const DATE_INTERVAL_ONE_YEAR = 'P1Y';

    /**
     * @test
     */
    public function testShouldInitialize()
    {
        new GoldRushService(new GoldRushRepository(new GoldRushResourceFactory()));
    }

    /**
     * @test
     */
    public function testGetInvestmentData()
    {
        $rawDataOne = new \stdClass();
        $rawDataOne->cena = 10.00;
        $rawDataOne->data = '2017-01-01';

        $rawDataTwo = new \stdClass();
        $rawDataTwo->cena = 40.00;
        $rawDataTwo->data = '2017-01-02';

        $rawDataCollection = [
            $rawDataOne,
            $rawDataTwo
        ];

        $goldRushResourceFactory = new GoldRushResourceFactory();
        $goldRushResourceCollection = $goldRushResourceFactory->buildGoldRushResourceCollection($rawDataCollection);

        $goldRushRepositoryMock = self::createMock(GoldRushRepository::class);
        $goldRushRepositoryMock
            ->method('getOneOzGoldPricesByDateRange')
            ->willReturn($goldRushResourceCollection);

        $goldRushService = new GoldRushService($goldRushRepositoryMock);
        $investmentData = $goldRushService->getInvestmentData(new DateTime(), 1, 10.00);

        self::assertInstanceOf(GoldRushDTO::class, $investmentData);

        self::assertEquals(10.00, $investmentData->getLowestCostOz());
        self::assertEquals(40.00, $investmentData->getHighestCostOz());
        self::assertEquals('2017-01-01', $investmentData->getBestMomentToBuy());
        self::assertEquals('2017-01-02', $investmentData->getBestMomentToSell());
        self::assertEquals(30.00, $investmentData->getInvestmentProfit());

        $now = new DateTime();
        $endDate = $now->format(self::DATE_FORMAT);
        $oneYearAgo = $now->sub(new DateInterval(self::DATE_INTERVAL_ONE_YEAR));
        $startDate = $oneYearAgo->format(self::DATE_FORMAT);

        self::assertEquals($startDate, $investmentData->getMinCheckedDate());
        self::assertEquals($endDate, $investmentData->getMaxCheckedDate());
    }

}