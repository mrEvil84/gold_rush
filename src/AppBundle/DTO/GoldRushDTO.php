<?php

namespace AppBundle\DTO;

use DateTime;

/**
 * Class GoldRushDTO
 * @package AppBundle\DTO
 */
class GoldRushDTO
{
    /**
     * @var string
     */
    private $bestMomentToBuy;

    /**
     * @var string
     */
    private $bestMomentToSell;

    /**
     * @var float
     */
    private $lowestCostOz;

    /**
     * @var float
     */
    private $highestCostOz;

    /**
     * @var float
     */
    private $investmentProfit;

    /**
     * @var string
     */
    private $minCheckedDate;

    /**
     * @var string
     */
    private $maxCheckedDate;

    /**
     * GoldRushDTO constructor.
     * @param string $bestMomentToBuy
     * @param string $bestMomentToSell
     * @param float $lowestCostOz
     * @param float $highestCostOz
     * @param float $investmentProfit
     * @param string $minCheckedDate
     * @param string $maxCheckedDate
     */
    public function __construct(
        $bestMomentToBuy,
        $bestMomentToSell,
        $lowestCostOz,
        $highestCostOz,
        $investmentProfit,
        $minCheckedDate,
        $maxCheckedDate
    ) {
        $this->bestMomentToBuy = $bestMomentToBuy;
        $this->bestMomentToSell = $bestMomentToSell;
        $this->lowestCostOz = $lowestCostOz;
        $this->highestCostOz = $highestCostOz;
        $this->investmentProfit = $investmentProfit;
        $this->minCheckedDate = $minCheckedDate;
        $this->maxCheckedDate = $maxCheckedDate;
    }

    /**
     * @return string
     */
    public function getBestMomentToBuy()
    {
        return $this->bestMomentToBuy;
    }

    /**
     * @return string
     */
    public function getBestMomentToSell()
    {
        return $this->bestMomentToSell;
    }

    /**
     * @return float
     */
    public function getLowestCostOz()
    {
        return $this->lowestCostOz;
    }

    /**
     * @return float
     */
    public function getHighestCostOz()
    {
        return $this->highestCostOz;
    }

    /**
     * @return float
     */
    public function getInvestmentProfit()
    {
        return $this->investmentProfit;
    }

    /**
     * @return string
     */
    public function getMinCheckedDate()
    {
        return $this->minCheckedDate;
    }

    /**
     * @return string
     */
    public function getMaxCheckedDate()
    {
        return $this->maxCheckedDate;
    }

    /**
     * @return int
     */
    public function getYearsCheckedCount()
    {
        $dateStart = new DateTime($this->minCheckedDate);
        $dateEnd = new DateTime($this->maxCheckedDate);
        $yearsCount = (int)$dateEnd->format('Y') - (int)$dateStart->format('Y');

        return $yearsCount;
    }

}