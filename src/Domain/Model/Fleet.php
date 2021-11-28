<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Model;

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

    public function registerVehicle(int $vehicleId): void
    {
        $vehicle = new Vehicle($vehicleId);
        $this->vehicles[] = $vehicle;
    }
}
