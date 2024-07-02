<?php
declare(Strict_types=1);
namespace test\Domain;

final class Location
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

    public function getDeviceId(): string
    {
        return $this->device;
    }
    public function getLatitude(): string
    {
        return $this->latitude;
    }
    public function getLongitude(): string
    {
        return $this->longitude;
    }
}

?>