<?php

namespace App\Classes;

use App\Interfaces\PlayerInterface;

class SpecificMechanics extends BasicMechanics
{
    const FIXED_PLAYER = 0;
    const FIXED_ROLL = 4;

    /**
     * @param PlayerInterface ...$players
     *
     * @return array
     */
    public function execute(PlayerInterface ...$players): array
    {
        $result = [];
        $i = 0;

        foreach ($players as $player) {
            $key = $player->getKey();
            $result[$key] = [
                'rolls' => [],
                'total' => 0
            ];

            if ($i++ === self::FIXED_PLAYER) {
                $firstRoll = $player->rollDice($this->dices[0]);
                $secondRoll = self::FIXED_ROLL;
                $result[$key]['rolls'] = [$firstRoll, $secondRoll];
            } else {
                foreach ($this->dices as $dice) {
                    $value = $player->rollDice($dice);
                    $result[$key]['rolls'][] = $value;
                }
            }

            $result[$key]['total'] += array_sum($result[$key]['rolls']);
        }

        return $result;
    }
}
