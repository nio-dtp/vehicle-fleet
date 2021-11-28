<?php

declare(strict_types=1);

namespace VehicleFleet\App\Command;

final class RegisterVehicle
{
    public function __construct(public int $fleetId, public int $vehicleId)
    {
    }
}
