<?php
declare(Strict_types=1);
namespace Juan\Test\Infrastructure;

use Juan\Test\Domain\Location;
use Juan\Test\Domain\LocationRepositoyInterface;

final class LocationRepositoryConn implements LocationRepositoyInterface
{
    private \PDO $conn;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function save(Location $location): void
    {
        $statement = $this->conn->prepare(query: '
            INSERT INTO locations (device, latitude, longitude) VALUES (:dev, :lat, :lon)
        ');
        $statement->execute([
            'dev' => $location->getDeviceId(),
            'lat' => $location->getLatitude(),
            'lon' => $location->getLongitude()
        ]);
    }
}

?>