<?php
declare(Strict_types=1);
namespace Juan\Test\Domain;

interface LocationRepositoyInterface
{
    public function save(Location $location): void;
}

?>