<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Contract\Bridge\Symfony\Routing\SymfonyRoutesProviderInterface;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../config/config.php');

    $rectorConfig->rule(\Lendable\LendableRector\Rector\FooRector::class);
};