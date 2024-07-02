<?php
declare(Strict_types=1);
namespace test\Domain;

final class MissingValueException extends \Expection
{
    private string $device;
    private string $latitude;
    private string $longitude;

    public function __construct(string $device, string $lat, string $lon)
    {
        $this->device = $device;
        $this->latitude = $lat;
        $this->longitude = $lon;
    }
}

?>