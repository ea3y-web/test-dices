<?php

namespace App\Classes;

class Dice
{
    /**
     * @return int
     */
    public function roll(): int
    {
        return random_int(1, 6);
    }
}
