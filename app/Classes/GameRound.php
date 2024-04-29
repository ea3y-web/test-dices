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
        foreach ($this->context->getPlayers() as $player) {
            $playerRolls = [];

            foreach ($this->context->getDices() as $key => $dice) {
                $playerRolls[] = $player->rollDice($dice);
            }

            $this->data[] = [
                'player' => $player->getKey(),
                'rolls' => $playerRolls,
                'total' => array_sum($playerRolls)
            ];
        }
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
        $maxScore = 0;
        $winner = '';

        foreach ($this->data as $item) {
            if ($item['total'] > $maxScore) {
                $maxScore = $item['total'];
                $winner = $item['player'];
            }
        }

        foreach ($this->context->getPlayers() as $player) {
            if ($player->getKey() === $winner) {
                return $player;
            }
        }

        return null;
    }
}
