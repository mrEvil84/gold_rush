<?php

namespace AppBundle\Repository;

use AppBundle\Exception\GoldRushException;
use AppBundle\Exception\GoldRushExceptionCodes;
use AppBundle\Resource\GoldRushResourceCollection;
use AppBundle\Resource\GoldRushResourceFactory;
use Curl\Curl;

/**
 * Class GoldRushRepository
 * @package AppBundle\Repository
 */
class GoldRushRepository
{
    const NBP_GOLD_API_URL = 'http://api.nbp.pl/api/cenyzlota';

    const FORMAT_JSON = ['format' => 'json'];

    /**
     * @var GoldRushResourceFactory
     */
    private $goldRushResourceFactory;

    /**
     * GoldRushRepository constructor.
     * @param GoldRushResourceFactory $goldRushResourceFactory
     */
    public function __construct(GoldRushResourceFactory $goldRushResourceFactory)
    {
        $this->goldRushResourceFactory = $goldRushResourceFactory;
    }

    /**
     * @throws GoldRushException
     */
    public function getCurrentOneOzGoldPrice()
    {
        $curl = new Curl();
        $curl->get(self::NBP_GOLD_API_URL, self::FORMAT_JSON);

        if (true === $curl->curl_error) {
            $curl->close();

            throw new GoldRushException(
                GoldRushExceptionCodes::getMessage(GoldRushExceptionCodes::SOURCE_DATA_ERROR),
                GoldRushExceptionCodes::SOURCE_DATA_ERROR
            );
        }

        if ('' === $curl->response) {
            $curl->close();

            throw new GoldRushException(
                GoldRushExceptionCodes::getMessage(GoldRushExceptionCodes::SOURCE_DATA_ERROR),
                GoldRushExceptionCodes::SOURCE_DATA_ERROR
            );
        }
        $curl->close();

        $exchangeData = json_decode($curl->response);

        return $this->goldRushResourceFactory->buildGoldRushResource($exchangeData[0]);
    }

    /**
     * @param string $dateFrom
     * @param string $dateTo
     * @return GoldRushResourceCollection
     * @throws GoldRushException
     */
    public function getOneOzGoldPricesByDateRange($dateFrom, $dateTo)
    {
        $curl = new Curl();
        $curl->get(self::NBP_GOLD_API_URL . '/' . $dateFrom . '/' . $dateTo . '/', self::FORMAT_JSON);

        if (true !== $curl->error && false === $curl->curl_error) {

            $exchangeData = json_decode($curl->response);

            $curl->close();
            return $this->goldRushResourceFactory->buildGoldRushResourceCollection($exchangeData);
        }

        $curl->close();
    }




}