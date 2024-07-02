<?php
declare(Strict_types=1);
namespace test\Domain;

interface LocationRepositoyInterface
{
    public function save(Location $location): void;
}

?>