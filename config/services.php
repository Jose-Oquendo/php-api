<?php

return [
    \PDO::class => function(){
        $dsn = sprintf('mysql:host=%s;dbname=%s', $_ENV['DB_HOST'], $_ENV['DB_NAME']); 
        return $pdo = new \PDO(
            $dsn,
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]
        );
    },
    Juan\Test\Domain\LocationRepositoyInterface::class => \DI\get(\Juan\Test\Infrastructure\LocationRepositoryConn::class)
];