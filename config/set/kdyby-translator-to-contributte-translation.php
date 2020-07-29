<?php

declare(strict_types=1);

use Rector\Renaming\Rector\Class_\RenameClassRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(RenameClassRector::class)
        ->call('configure', [[
            '$oldToNewClasses' => [
                'Kdyby\Translation\Translator' => 'Nette\Localization\ITranslator',
                'Kdyby\Translation\DI\ITranslationProvider' => 'Contributte\Translation\DI\TranslationProviderInterface',
                'Kdyby\Translation\Phrase' => 'Contributte\Translation\Wrappers\Message',
            ],
        ]]);
};
