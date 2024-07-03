<?php
declare(Strict_types=1);
namespace Infrastructure;

namespace test\Infrastructure\LocationRepositoryConn;
namespace test\Domain\Location;

final class LocationRepositoryTest extends \PHPUnit\Framework\TestCase
{
    public function testSave(): void
    {
        $repository = $this->getRepository();
        $location = $this->getLocationObject();

        $repository->save($location);
        $this->assertTrue($this->existingDB($lcoation), message: 'El objeto no se ha creado correctamente.');
    }

    
    private function getPdo(): \PDO
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s', $_ENV['DB_HOST'], $_ENV['DB_NAME']); 
        return new \PDO(
            $dsn,
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    private function getRepository(): LocationRepositoryConn
    {
        return new LocationRepositoryConn($this->getPdo());
    }

    private function getLocationObject(): Location
    {
        return new Location(
            "25769c6c-d34d-4bfe-ba98-e0ee856f3e7a",
            "12.1111",
            "12.1111"
        );
    }

    private function existingDB(Location $locations): bool
    { 
        $statement = $this->getPdo()->prepare("SELECT * 
        FROM locations 
            WHERE device = ?
            AND latitude = ?
            AND longitude = ?
        ");
        $statement->execute([
            $location->getDeviceId(),
            $location->getLatitude(),
            $location->getLongitude(),
        ]);

        return $statement->rowCount() == 1;
    }
}

?>