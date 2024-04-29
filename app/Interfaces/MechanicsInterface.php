<?php

namespace App\Interfaces;

interface MechanicsInterface
{
    public function execute(PlayerInterface ...$players): array;
}
