<?php
/**
 * Created by PhpStorm.
 * User: pkowerzanow
 * Date: 06.02.2017
 * Time: 22:18
 */

namespace AppBundle\Resource;

/**
 * Class GoldRushResourceFactory
 * @package AppBundle\Resource
 */
class GoldRushResourceFactory
{
    /**
     * @param \stdClass $rawData
     * @return GoldRushResource
     */
    public function buildGoldRushResource(\stdClass $rawData)
    {
        return new GoldRushResource($rawData->cena, $rawData->data);
    }

    /**
     * @param array $rawData
     * @return GoldRushResourceCollection
     */
    public function buildGoldRushResourceCollection(array $rawData)
    {
        $collection = new GoldRushResourceCollection();
        foreach ($rawData as $rawDataItem) {
            $collection->addItem(new GoldRushResource($rawDataItem->cena, $rawDataItem->data));
        }

        return $collection;
    }

}