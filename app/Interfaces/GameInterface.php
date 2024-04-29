<?php

namespace App\Interfaces;

interface GameInterface
{
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
     * @param int $rounds
     *
     * @return self
     */
    public function setRounds(int $rounds): self;

    /**
     * @return int
     */
    public function getRounds(): int;
}
