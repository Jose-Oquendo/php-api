<?php
declare(Strict_types=1);
namespace Infrastructure;

use Juan\Test\Domain\Location;
use Juan\Test\Infrastructure;
use Juan\Test\Infrastructure\LocationRepositoryConn;

final class LocationRepositoryTest extends \PHPUnit\Framework\TestCase
{
    public function testSave()
    {
        $repository = $this->getRepository();
        $location = $this->getLocationObject();

        // $repositorys->save($location);
        $validate = $this->existingDB($location);
        $this->assertTrue($validate, 'El objeto no existe en la base de datos mysql'.$validate);

        $this->deleteLocation($location);
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

    private function existingDB(Location $location): bool
    { 
        $statement = $this->getPdo()->prepare("SELECT * 
        FROM locations 
            WHERE device = ?
            AND latitude = ?
            AND longitude = ?
        ");
        $params = [
            $location->getDeviceId(),
            $location->getLatitude(),
            $location->getLongitude(),
        ];
        $statement->execute($params);
        
        if($statement->rowCount() > 0){
            return false;
        } else {
            return true;
        }
    }

    protected function deleteLocation(Location $location): void
    {
        $this->getPdo()->prepare('DELETE FROM locations WHERE device = ?')->execute(
            [
                $location->getDeviceId()
            ]
        );
    }
}

?>