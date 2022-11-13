<?php

declare(strict_types=1);

namespace Lendable\Entity;

class Thermometer
{
    private float $temperature;

    public function setTemperature(float $temperature)
    {
        $this->temperature = $temperature;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }
}