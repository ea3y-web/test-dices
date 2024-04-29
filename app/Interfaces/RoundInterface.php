<?php

namespace App\Interfaces;

interface RoundInterface
{
    /**
     * @param GameInterface $game
     *
     * @return void
     */
    public function setContext(GameInterface $game);

    /**
     * @return void
     */
    public function run();

    /**
     * @return array
     */
    public function getData(): array;
}
