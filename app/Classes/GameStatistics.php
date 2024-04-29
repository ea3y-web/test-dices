<?php

namespace App\Classes;

use App\Interfaces\StatisticsInterface;

class GameStatistics implements StatisticsInterface
{
    /**
     * @var array
     */
    private array $records = [];

    /**
     * @param array $data
     *
     * @return self
     */
    public function addRecord(array $data): self
    {
        $this->records[] = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function getRecords(): array
    {
        return $this->records;
    }
}
