<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->importNames();

    $rectorConfig->parallel();

    $rectorConfig->paths([__DIR__ . '/src', __DIR__ . '/tests']);

    $rectorConfig->skip([
        '*/Source/*',
        '*/Fixture/*',
    ]);

    $rectorConfig->sets([
        // needed for DEAD_CODE list, just in split package like this
        __DIR__ . '/config/config.php',
    ]);
};
