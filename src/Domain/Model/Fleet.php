<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Model;

use VehicleFleet\Domain\Exception\VehicleAlreadyRegistered;

final class Fleet
{
    /**
     * @param Vehicle[] $vehicles
     */
    public function __construct(
        private int $id,
        private int $userId,
        private array $vehicles
    ) {
    }

    /**
     * @throws VehicleAlreadyRegistered
     */
    public function registerVehicle(int $vehicleId): void
    {
        $vehicle = new Vehicle($vehicleId);
        if ($this->hasVehicle($vehicle)) {
            throw new VehicleAlreadyRegistered($this->id, $vehicleId);
        }
        $this->vehicles[] = $vehicle;
    }

    private function hasVehicle(Vehicle $vehicle): bool
    {
        foreach ($this->vehicles as $fleetVehicle) {
            if ($vehicle->isEqualTo($fleetVehicle)) {
                return true;
            }
        }

        return false;
    }
}
