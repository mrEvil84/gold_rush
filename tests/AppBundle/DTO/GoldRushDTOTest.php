<?php

namespace Tests\AppBundle\DTO;


use AppBundle\DTO\GoldRushDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class GoldRushDTOTest
 * @package Tests\AppBundle\DTO
 */
class GoldRushDTOTest extends TestCase
{

    /**
     * @test
     */
    public function testGoldRushDTO()
    {

        $goldRushDTO = new GoldRushDTO(
            '2017-01-01',
            '2017-01-20',
            145.34,
            180.99,
            50.23,
            '2017-01-01',
            '2017-01-20'
        );

        $expectedBestMomentToBuy = '2017-01-01';
        $expectedBestMomentToSell = '2017-01-20';
        $expectedLowestCostOz = 145.34;
        $expectedHighestCostOz = 180.99;
        $expectedInvestmentProfit = 50.23;
        $expectedYearsCheckedCount = 0;
        $expectedMinCheckedDate = '2017-01-01';
        $expectedMaxCheckedDate = '2017-01-20';

        self::assertEquals($expectedBestMomentToBuy, $goldRushDTO->getBestMomentToBuy());
        self::assertEquals($expectedBestMomentToSell, $goldRushDTO->getBestMomentToSell());
        self::assertEquals($expectedLowestCostOz, $goldRushDTO->getLowestCostOz());
        self::assertEquals($expectedHighestCostOz, $goldRushDTO->getHighestCostOz());
        self::assertEquals($expectedInvestmentProfit, $goldRushDTO->getInvestmentProfit());
        self::assertEquals($expectedMinCheckedDate, $goldRushDTO->getMinCheckedDate());
        self::assertEquals($expectedMaxCheckedDate, $goldRushDTO->getMaxCheckedDate());

        self::assertEquals($expectedYearsCheckedCount, $goldRushDTO->getYearsCheckedCount());
    }

}