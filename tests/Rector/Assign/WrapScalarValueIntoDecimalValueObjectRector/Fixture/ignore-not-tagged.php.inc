<?php

use Lendable\Entity\Thermometer;

class IgnoreTag
{
    public function calculate(Thermometer $thermometer): void
    {
        $temperature = $thermometer->getTemperature();
    }
}
