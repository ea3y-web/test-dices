<?php

namespace App\Interfaces;

interface StatisticsInterface
{
    /**
     * @param array $data
     *
     * @return self
     */
    public function addRecord(array $data);

    /**
     * @return array
     */
    public function getRecords(): array;
}
