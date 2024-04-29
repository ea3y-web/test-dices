<?php

namespace App\Interfaces;

interface GameInterface
{
    /**
     * @param RulesInterface $rules
     *
     * @return self
     */
    public function setRules(RulesInterface $rules): self;

    /**
     * @return RulesInterface
     */
    public function getRules(): RulesInterface;

    /**
     * @param PlayerInterface $player
     *
     * @return self
     */
    public function addPlayer(PlayerInterface $player): self;

    /**
     * @return array
     */
    public function getPlayers(): array;

    /**
     * @return void
     */
    public function run();
}
