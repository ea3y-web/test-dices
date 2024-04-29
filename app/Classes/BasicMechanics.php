<?php

namespace App\Classes;

use App\Interfaces\MechanicsInterface;
use App\Interfaces\PlayerInterface;

class BasicMechanics implements MechanicsInterface
{
    /**
     * @var array
     */
    private array $dices;

    /**
     * @param Dice ...$dices
     *
     * @return self
     */
    public function withDices(Dice ...$dices): self
    {
        $this->dices = $dices;

        return $this;
    }

    /**
     * @param PlayerInterface ...$players
     *
     * @return array
     */
    public function execute(PlayerInterface ...$players): array
    {
        $result = [];

        foreach ($players as $player) {
            $result[$player->getKey()] = [
                'rolls' => [],
                'total' => 0
            ];

            foreach ($this->dices as $dice) {
                $value = $player->rollDice($dice);

                $result[$player->getKey()]['rolls'][] = $value;
                $result[$player->getKey()]['total'] += $value;
            }
        }

        return $result;
    }
}
