<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnCastRector;

return RectorConfig::configure()
    ->withRules([ReturnTypeFromReturnCastRector::class]);
