<?php

declare(strict_types=1);

namespace VehicleFleet\App\Command;

use VehicleFleet\Domain\Exception\FleetNotFound;
use VehicleFleet\Domain\Exception\VehicleAlreadyRegistered;
use VehicleFleet\Domain\Repository\FleetRepositoryInterface;

final class RegisterVehicleHandler
{
    public function __construct(private FleetRepositoryInterface $fleetRepository)
    {
    }

    /**
     * @throws FleetNotFound
     * @throws VehicleAlreadyRegistered
     */
    public function handle(RegisterVehicle $registerVehicle): void
    {
        $fleet = $this->fleetRepository->getById($registerVehicle->fleetId);
        $fleet->registerVehicle($registerVehicle->vehicleId);

        $this->fleetRepository->save($fleet);
    }
}
