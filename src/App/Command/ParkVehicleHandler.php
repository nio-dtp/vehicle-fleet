<?php

declare(strict_types=1);

namespace VehicleFleet\App\Command;

use VehicleFleet\Domain\Exception\FleetNotFound;
use VehicleFleet\Domain\Exception\VehicleNotFound;
use VehicleFleet\Domain\Repository\FleetRepositoryInterface;

final class ParkVehicleHandler
{
    public function __construct(private FleetRepositoryInterface $fleetRepository)
    {
    }

    /**
     * @throws FleetNotFound
     * @throws VehicleNotFound
     */
    public function handle(ParkVehicle $parkVehicle): void
    {
        $fleet = $this->fleetRepository->getById($parkVehicle->fleetId);
        $fleet->parkVehicle($parkVehicle->vehicleId, $parkVehicle->latitude, $parkVehicle->longitude, $parkVehicle->altitude);

        $this->fleetRepository->save($fleet);
    }
}
