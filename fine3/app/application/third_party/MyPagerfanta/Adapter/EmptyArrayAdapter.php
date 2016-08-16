<?php 

namespace MyPagerfanta\Adapter;

class EmptyArrayAdapter implements \Pagerfanta\Adapter\AdapterInterface
{

    private $totalCount;

    public function __construct($totalCount)
    {
        $this->totalCount = (int)$totalCount;
    }

    public function getNbResults()
    {
        return $this->totalCount;
    }

    public function getSlice($offset, $length)
    {
        return array();
    }

}