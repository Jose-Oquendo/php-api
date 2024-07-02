<?php
declare(Strict_types=1);
namespace test\Application;
use test\Domain\Location;
use test\Domain\LocationRepositoyInterface;

final class RegisterLcationAction
{
    private LocationRepositoyInterface $locationRepository;

    public function __construct(LocationRepositoyInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function __invoke(string $device, string $lat, string $lon)
    {
        $this->validate($device, $lat, $lon);
        $location = new Location($device, $lat, $lon);
        $this->locationRepository->save($location);
    }

    private function validate(string $device, string $lat, string $lon)
    {
        if(empty($device)){
            throw new MissingValueException();
        }
        if(empty($lat) || empty($lon)){
            throw new MissingValueException();
        }
    }
}

?>