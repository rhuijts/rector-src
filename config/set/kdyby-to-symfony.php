<?php

declare(strict_types=1);

use Rector\Generic\Rector\Visibility\ChangeMethodVisibilityRector;
use Rector\NetteToSymfony\Rector\MethodCall\WrapTransParameterNameRector;
use Rector\Renaming\Rector\Class_\RenameClassRector;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(ChangeMethodVisibilityRector::class)
        ->call('configure', [[
            '$methodToVisibilityByClass' => [
                'Kdyby\Events\Subscriber' => [
                    'getSubscribedEvents' => 'static',
                ],
            ],
        ]]);

    $services->set(RenameMethodRector::class)
        ->call('configure', [[
            '$oldToNewMethodsByClass' => [
                'Kdyby\Translation\Translator' => [
                    'translate' => 'trans',
                ],
                'Kdyby\RabbitMq\IConsumer' => [
                    'process' => 'execute',
                ],
            ],
        ]]);

    $services->set(RenameClassRector::class)
        ->call('configure', [[
            '$oldToNewClasses' => [
                'Kdyby\RabbitMq\IConsumer' => 'OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface',
                'Kdyby\RabbitMq\IProducer' => 'OldSound\RabbitMqBundle\RabbitMq\ProducerInterface',
                'Kdyby\Monolog\Logger' => 'Psr\Log\LoggerInterface',
                'Kdyby\Events\Subscriber' => 'Symfony\Component\EventDispatcher\EventSubscriberInterface',
                'Kdyby\Translation\Translator' => 'Symfony\Contracts\Translation\TranslatorInterface',
            ],
        ]]);

    $services->set(WrapTransParameterNameRector::class);
};
