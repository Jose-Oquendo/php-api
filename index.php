<?php
    require __DIR__.'/launch.php';

    $containerBuilder = new \DI\ContainerBuilder();
    $containerBuilder->useAutowiring(true);
    $containerBuilder->addDefinitions(__DIR__.'/config/services.php');
    $container = $containerBuilder->build();

    class Body {

    }
    echo get_class($container->get(\Juan\Test\Domain\LocationRepositoyInterface::class))."\n";
?>