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
    protected StatisticsInterface $history;

    /**
     * @var RulesInterface
     */
    protected RulesInterface $rules;

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
    public function __construct(StatisticsInterface $history)
    {
        $this->history = $history;
        $this->rounds = 100;
        $this->players = [];
    }

    /**
     * @return StatisticsInterface
     */
    public function getStatistics(): StatisticsInterface
    {
        return $this->history;
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
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < $this->rounds; $i++) {
            $round = new GameRound;
            $this->progress[] = $round;

            $round->setContext($this)->play();
            $this->history->addRecord([
                'round'     => $i + 1,
                'players'   => $this->players,
                'winner'    => $round->getWinner(),
                'details'   => $round->getData()
            ]);
        }
    }

    /**
     * @return PlayerInterface|null
     */
    public function getWinner(): ?PlayerInterface
    {
        $rating = array_combine(
            array_keys($this->players),
            array_fill(0, count($this->players), 0)
        );

        foreach ($this->history->getRecords() as $data) {
            if (isset($data['winner'])) {
                $rating[$data['winner']->getKey()] += 1;
            }
        }

        arsort($rating);

        return end($rating) === reset($rating)
            ? null
            : $this->players[array_key_first($rating)];
    }
}
