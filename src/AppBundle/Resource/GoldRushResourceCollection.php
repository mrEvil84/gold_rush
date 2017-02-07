<?php

namespace AppBundle\Resource;


use ArrayIterator;
use Collection;
use Iterator;
use IteratorAggregate;

/**
 * Class GoldRushResourceCollection
 * @package AppBundle\Resource
 */
class GoldRushResourceCollection implements IteratorAggregate
{
    /**
     * @var array
     */
    protected $goldRushResourceCollection = [];

    /**
     * @param GoldRushResource $goldRushResource
     */
    public function addItem(GoldRushResource $goldRushResource) {
        $this->goldRushResourceCollection[] = $goldRushResource;
    }

    /**
     * @return Collection
     */
    public function getIterator()
    {
        return new ArrayIterator($this->goldRushResourceCollection);
    }



}