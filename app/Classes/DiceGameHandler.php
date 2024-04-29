<?php

namespace App\Classes;

use App\Interfaces\GameInterface;
use App\Interfaces\PlayerInterface;
use App\Interfaces\RulesInterface;
use App\Interfaces\StatisticsInterface;

class DiceGameHandler implements GameInterface
{
    /**
     * @var StatisticsInterface
     */
    protected StatisticsInterface $statistics;

    /**
     * @var RulesInterface
     */
    protected RulesInterface $rules;

    /**
     * @var Dice[]
     */
    protected array $dices;

    /**
     * @var int
     */
    protected int $rounds;

    /**
     * @var array
     */
    protected array $players;

    /**
     * @return void
     */
    public function __construct(StatisticsInterface $statistics)
    {
        $this->statistics = $statistics;
        $this->dices = [new Dice, new Dice];
        $this->rounds = 100;
        $this->players = [];
    }

    /**
     * @return StatisticsInterface
     */
    public function getStatistics(): StatisticsInterface
    {
        return $this->statistics;
    }

    /**
     * @param RulesInterface $rules
     *
     * @return self
     */
    public function setRules(RulesInterface $rules): self
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * @return RulesInterface
     */
    public function getRules(): RulesInterface
    {
        return $this->rules;
    }

    /**
     * @return array
     */
    public function getDices(): array
    {
        return $this->dices;
    }

    /**
     * @param int $value
     *
     * @return self
     */
    public function setRounds(int $value): self
    {
        $this->rounds = $value > 0 ? $value : 1;

        return $this;
    }

    /**
     * @return int
     */
    public function getRounds(): int
    {
        return $this->rounds;
    }

    /**
     * @param PlayerInterface $player
     *
     * @return self
     */
    public function addPlayer(PlayerInterface $player): self
    {
        $this->players[$player->getKey()] = $player;

        return $this;
    }

    /**
     * @return PlayerInterface[]
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @return void
     */
    public function play()
    {
        for ($i = 0; $i < $this->rounds; $i++) {
            $round = new GameRound;
            $round->setContext($this)->run();

            $this->statistics->addRecord([
                'round' => $i + 1,
                'winner' => $round->getWinner(),
                'details' => $round->getData()
            ]);
        }
    }

    /**
     * @return ?PlayerInterface
     */
    public function getWinner(): ?PlayerInterface
    {
        $rating = [];

        foreach ($this->players as $player) {
            $rating[$player->getKey()] = 0;
        }

        foreach ($this->statistics->getRecords() as $record) {
            if (isset($record['winner'])) {
                $rating[$record['winner']->getKey()]++;
            }
        }

        arsort($rating);

        return $this->players[array_key_first($rating)];
    }
}
