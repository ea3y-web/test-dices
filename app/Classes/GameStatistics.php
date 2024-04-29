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

    /**
     * @return array
     */
    public function byPlayer(): array
    {
        $data = [];

        foreach ($this->records as $record) {
            if (isset($record['winner'])) {
                $player = $record['winner']->getName();

                if (isset($data[$player])) {
                    $data[$player]['wins'] += 1;
                } else {
                    $data[$player] = ['wins' => 1, 'draws' => 0];
                }
            } else {
                foreach ($record['players'] as $player) {
                    if (isset($data[$player->getName()])) {
                        $data[$player->getName()]['draws'] += 1;
                    } else {
                        $data[$player->getName()] = ['wins' => 0, 'draws' => 1];
                    }
                }
            }
        }

        return $data;
    }
}
