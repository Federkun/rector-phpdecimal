<?php

use Lendable\Entity\Thermometer;

class IgnoreRegularPlusOperation
{
    public function calculate(Thermometer $primary, Thermometer $secondary): void
    {
        $firstTemperature = $primary->getTemperature();
        $secondTemperature = $secondary->getTemperature();

        $total = $firstTemperature + $secondTemperature;
    }
}
