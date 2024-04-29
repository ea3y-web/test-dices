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
     * @return void
     */
    public function __construct()
    {
        $this->key = Str::random(8);
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
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

    public function play()
    {

    }
}
