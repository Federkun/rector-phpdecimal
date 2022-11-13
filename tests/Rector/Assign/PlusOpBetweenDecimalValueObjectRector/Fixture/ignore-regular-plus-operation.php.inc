<?php

use Lendable\Entity\Thermometer;

class IgnoreResularPlusOperation
{
    public function calculate(Thermometer $primary, Thermometer $secondary): void
    {
        $firstTemperature = $primary->getTemperature();
        $secondTemperature = $secondary->getTemperature();

        $total = $firstTemperature + $secondTemperature;
    }
}
