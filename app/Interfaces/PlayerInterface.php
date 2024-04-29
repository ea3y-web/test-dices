<?php

namespace App\Interfaces;

interface PlayerInterface
{
    public function getKey(): string;

    public function play();
}
