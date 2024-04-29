<?php

namespace App\Interfaces;

interface PlayerInterface
{
    /**
     * @return string
     */
    public function getKey(): string;

    /**
     * @return string
     */
    public function getName(): string;
}
