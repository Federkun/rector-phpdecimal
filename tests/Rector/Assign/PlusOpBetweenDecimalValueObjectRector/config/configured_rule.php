<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Lendable\LendableRector\Rector\Assign\PlusOpBetweenDecimalValueObjectRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');

    $rectorConfig->rule(PlusOpBetweenDecimalValueObjectRector::class);
};