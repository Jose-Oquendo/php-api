<?php
declare(Strict_types=1);
namespace test\Infrastructure;
use test\Domain\Location;

final class LocationRepositoyConn implements test\Domain\LocationRepositoyInterface
{
    private \PDO $conn;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function save(Location $location): void
    {
        $statement = $this->conn->prepare(query: '
            INSERT INTO locations (device, lat, lon) VALUES (:dev, :lat, :lon)
        ');
        $statement->execute([
            'dev' => $location->getDeviceId(),
            'lat' => $location->getLatitude(),
            'lon' => $location->getLongitude()
        ]);
    }
}

?>