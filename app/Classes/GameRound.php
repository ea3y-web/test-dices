<?php

namespace App\Classes;

use App\Interfaces\GameInterface;
use App\Interfaces\PlayerInterface;
use App\Interfaces\RoundInterface;

class GameRound implements RoundInterface
{
    /**
     * @var GameInterface
     */
    private GameInterface $context;

    /**
     * @var array
     */
    private array $data = [];

    /**
     * @param GameInterface $game
     *
     * @return self
     */
    public function setContext(GameInterface $game): self
    {
        $this->context = $game;

        return $this;
    }

    /**
     * @return void
     */
    public function run()
    {
        $mechanics = $this->context->getRules()->getTurnMechanics();

        $this->data = $mechanics->withDices(...$this->context->getDices())
            ->execute(...$this->context->getPlayers());
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return PlayerInterface|null
     */
    public function getWinner(): ?PlayerInterface
    {
        $winner = $this->context->getRules()->determineRoundWinner($this);

        return isset($winner) ? $this->context->getPlayers()[$winner] : null;
    }
}
