<?php

declare(strict_types=1);

namespace VehicleFleet\App\Command;

final class ParkVehicle
{
    public function __construct(public string $fleetId, public string $vehicleId, public float $latitude, public float $longitude, public ?int $altitude)
    {
    }
}
