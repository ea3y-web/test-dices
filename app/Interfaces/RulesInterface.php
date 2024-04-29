<?php

namespace App\Interfaces;

interface RulesInterface
{
    /**
     * @return MechanicsInterface
     */
    public function getTurnMechanics(): MechanicsInterface;

    /**
     * @param RoundInterface $round
     *
     * @return mixed
     */
    public function determineRoundWinner(RoundInterface $round);
}
