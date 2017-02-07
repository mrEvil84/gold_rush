<?php

namespace AppBundle\Service;

use AppBundle\DTO\GoldRushDTO;
use AppBundle\Repository\GoldRushRepository;
use AppBundle\Resource\GoldRushResourceCollection;
use DateInterval;
use DateTime;

/**
 * Class GoldRushService
 * @package AppBundle\Service
 */
class GoldRushService
{
    const DATE_INTERVAL_ONE_YEAR = 'P1Y';

    const DATE_FORMAT = 'Y-m-d';

    /**
     * @var goldRushRepository
     */
    private $goldRushRepository;

    /**
     * GoldRushService constructor.
     * @param GoldRushRepository $goldRushRepository
     */
    public function __construct(GoldRushRepository $goldRushRepository)
    {
        $this->goldRushRepository = $goldRushRepository;
    }

    /**
     * @param DateTime $nowDate
     * @param int $yearsToCheck
     * @param float $amountOfInvestment
     * @return GoldRushDTO
     */
    public function getInvestmentData(DateTime $nowDate, $yearsToCheck = 10, $amountOfInvestment = 600000.00)
    {
        if (false === is_float($amountOfInvestment)) {
            $amountOfInvestment = floatval($amountOfInvestment);
        }

        $dateRange = [];
        $minPriceResources = [];
        $maxPriceResources = [];

            for ($i = 1; $i <= $yearsToCheck; $i++) {
            $endDate = $nowDate->format(self::DATE_FORMAT);
            $oneYearAgo = $nowDate->sub(new DateInterval(self::DATE_INTERVAL_ONE_YEAR));
            $startDate = $oneYearAgo->format(self::DATE_FORMAT);

            $goldRushResourceCollection = $this->goldRushRepository->getOneOzGoldPricesByDateRange(
                $startDate,
                $endDate
            );

            if ($goldRushResourceCollection instanceof GoldRushResourceCollection) {
                $rawDataGoldRushCollection = $this->extractDataCollection($goldRushResourceCollection);

                $dateRange[] = $startDate;
                $dateRange[] = $endDate;
                $minPriceResources[] = min($rawDataGoldRushCollection);
                $maxPriceResources[] = max($rawDataGoldRushCollection);
            }
        }

        $lowestGoldOzCost = min($minPriceResources);
        $highestGoldOzCost = max($maxPriceResources);

        $buyOzCountByLowestPrice = (int)($amountOfInvestment / $lowestGoldOzCost['exchangeRate']);
        $sellOzByHighestPrice = (float)$buyOzCountByLowestPrice * $highestGoldOzCost['exchangeRate'];
        $profitFromInvestment = $sellOzByHighestPrice - $amountOfInvestment;

        return new GoldRushDTO(
            $lowestGoldOzCost['exchangeDate'],
            $highestGoldOzCost['exchangeDate'],
            $lowestGoldOzCost['exchangeRate'],
            $highestGoldOzCost['exchangeRate'],
            $profitFromInvestment,
            min($dateRange),
            max($dateRange)
        );
    }

    /**
     * @param GoldRushResourceCollection $goldRushResourceCollection
     * @return array
     */
    private function extractDataCollection(GoldRushResourceCollection $goldRushResourceCollection)
    {
        $collection = [];
        foreach ($goldRushResourceCollection as $goldRushResource) {
            $collection[] = $goldRushResource->toArray();
        }

        return $collection;
    }


}