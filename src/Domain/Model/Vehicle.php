<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Model;

final class Vehicle
{
    private ?float $latitude;
    private ?float $longitude;
    private ?int $altitude;

    public function __construct(
        private int $id
    ) {
    }

    public function park(float $latitude, float $longitude, ?int $altitude): void
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->altitude = $altitude;
    }

    public function isEqualTo(Vehicle $vehicle): bool
    {
        return $vehicle->getId() === $this->id;
    }

    public function isParkedAtThisLocation(float $latitude, float $longitude, ?int $altitude): bool
    {
        return $latitude === $this->latitude && $longitude === $this->longitude && $altitude === $this->altitude;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
