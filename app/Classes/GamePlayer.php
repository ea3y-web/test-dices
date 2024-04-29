<?php

namespace App\Classes;

use App\Interfaces\PlayerInterface;
use Illuminate\Support\Str;

class GamePlayer implements PlayerInterface
{
    /**
     * @var string
     */
    private string $key;

    /**
     * @var string
     */
    private string $name;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->key = Str::random(8);
        $this->name = fake()->name();
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Dice $dice
     *
     * @return int
     */
    public function rollDice(Dice $dice): int
    {
        return $dice->roll();
    }
}
