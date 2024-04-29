<?php

namespace App\Classes;

use App\Interfaces\MechanicsInterface;
use App\Interfaces\RoundInterface;
use App\Interfaces\RulesInterface;

class ClassicRules implements RulesInterface
{
    /**
     * @return MechanicsInterface
     */
    public function getTurnMechanics(): MechanicsInterface
    {
        return new BasicMechanics;
    }

    /**
     * @param RoundInterface $round
     *
     * @return string|null
     */
    public function determineRoundWinner(RoundInterface $round): ?string
    {
        $maxScore = max(array_column($round->getData(), 'total'));
        $playerHighestRolls = [];

        foreach ($round->getData() as $player => $result) {
            if ($result['total'] < $maxScore) {
                continue;
            }

            $playerHighestRolls[$player] = max($result['rolls']);
        }

        if (count($playerHighestRolls) === 1) {
            return array_key_first($playerHighestRolls);
        }

        asort($playerHighestRolls);

        if (reset($playerHighestRolls) === end($playerHighestRolls)) {
            return null;
        } else {
            return array_key_last($playerHighestRolls);
        }
    }
}
