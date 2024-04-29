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
        return new SpecificMechanics;
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

        arsort($playerHighestRolls);

        if (count($playerHighestRolls) > 1 && reset($playerHighestRolls) === end($playerHighestRolls)) {
            return null;
        }

        return array_key_first($playerHighestRolls);
    }
}
