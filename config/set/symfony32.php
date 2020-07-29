<?php

declare(strict_types=1);

use Rector\Generic\Rector\Argument\ArgumentAdderRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(ArgumentAdderRector::class)
        ->call('configure', [[
            '$positionWithDefaultValueByMethodNamesByClassTypes' => [
                'Symfony\Component\DependencyInjection\ContainerBuilder' => [
                    'addCompilerPass' => [
                        2 => [
                            'name' => 'priority',
                            'default_value' => 0,
                        ],
                    ],
                ],
            ],
        ]]);
};
