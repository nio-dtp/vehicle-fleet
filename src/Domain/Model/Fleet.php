<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Model;

use VehicleFleet\Domain\Exception\VehicleAlreadyParked;
use VehicleFleet\Domain\Exception\VehicleAlreadyRegistered;
use VehicleFleet\Domain\Exception\VehicleNotFound;

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
        if ($this->hasVehicle($vehicleId)) {
            throw new VehicleAlreadyRegistered($this->id, $vehicleId);
        }
        $this->vehicles[] = new Vehicle($vehicleId);
    }

    /**
     * @throws VehicleNotFound
     * @throws VehicleAlreadyParked
     */
    public function parkVehicle(int $vehicleId, float $latitude, float $longitude, ?int $altitude): void
    {
        $vehicle = $this->getVehicle($vehicleId);
        if (null === $vehicle) {
            throw new VehicleNotFound($this->id, $vehicleId);
        }
        if ($vehicle->isParkedAtThisLocation($latitude, $longitude, $altitude)) {
            throw new VehicleAlreadyParked($vehicleId, $latitude, $longitude, $altitude);
        }
        $vehicle->park($latitude, $longitude, $altitude);
    }

    private function hasVehicle(int $vehicleId): bool
    {
        return null !== $this->getVehicle($vehicleId);
    }

    private function getVehicle(int $vehicleId): ?Vehicle
    {
        $vehicle = new Vehicle($vehicleId);
        foreach ($this->vehicles as $fleetVehicle) {
            if ($fleetVehicle->isEqualTo($vehicle)) {
                return $fleetVehicle;
            }
        }

        return null;
    }
}
