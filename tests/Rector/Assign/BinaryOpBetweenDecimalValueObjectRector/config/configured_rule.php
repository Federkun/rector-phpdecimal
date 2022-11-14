<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Lendable\LendableRector\Rector\Assign\BinaryOpBetweenDecimalValueObjectRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');

    $rectorConfig->rule(BinaryOpBetweenDecimalValueObjectRector::class);
};