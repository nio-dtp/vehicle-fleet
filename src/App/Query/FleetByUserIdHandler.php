<?php

declare(strict_types=1);

namespace VehicleFleet\App\Query;

use VehicleFleet\Domain\Exception\FleetNotFound;
use VehicleFleet\Domain\Model\Fleet;
use VehicleFleet\Domain\Repository\FleetRepositoryInterface;

final class FleetByUserIdHandler
{
    public function __construct(private FleetRepositoryInterface $fleetRepository)
    {
    }

    /**
     * @throws FleetNotFound
     */
    public function handle(FleetByUserId $fleetByUserId): Fleet
    {
        return $this->fleetRepository->getByUserId($fleetByUserId->userId);
    }
}
