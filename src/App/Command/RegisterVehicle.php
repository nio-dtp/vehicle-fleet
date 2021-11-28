<?php

declare(strict_types=1);

namespace VehicleFleet\App\Command;

final class RegisterVehicle
{
    public function __construct(public string $fleetId, public string $vehicleId)
    {
    }
}
