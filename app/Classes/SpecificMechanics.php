<?php

namespace App\Classes;

use App\Interfaces\PlayerInterface;

class SpecificMechanics extends BasicMechanics
{
    /**
     * @param PlayerInterface ...$players
     *
     * @return array
     */
    public function execute(PlayerInterface ...$players): array
    {
        $result = [];
        $i = 0;

        foreach ($players as $key => $player) {
            $result[$player->getKey()] = [
                'rolls' => [],
                'total' => 0
            ];

            if ($i++ === 0) {
                $firstRoll = $player->rollDice($this->dices[0]);
                $secondRoll = 4;

                $result[$player->getKey()]['rolls']= [$firstRoll, $secondRoll];
                $result[$player->getKey()]['total'] += $firstRoll + $secondRoll;
            } else {
                foreach ($this->dices as $dice) {
                    $value = $player->rollDice($dice);

                    $result[$player->getKey()]['rolls'][] = $value;
                    $result[$player->getKey()]['total'] += $value;
                }
            }
        }

        return $result;
    }
}
