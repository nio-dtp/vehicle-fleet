<?php

declare(strict_types=1);

namespace VehicleFleet\App\Command;

use VehicleFleet\Domain\Exception\FleetAlreadyCreated;
use VehicleFleet\Domain\Exception\FleetNotFound;
use VehicleFleet\Domain\Model\Fleet;
use VehicleFleet\Domain\Repository\FleetRepositoryInterface;

final class CreateFleetHandler
{
    public function __construct(private FleetRepositoryInterface $fleetRepository)
    {
    }

    /**
     * @throws FleetAlreadyCreated
     */
    public function handle(CreateFleet $createFleet): void
    {
        try {
            $existingFleet = $this->fleetRepository->getByUserId($createFleet->userId);
        } catch (FleetNotFound $exception) {
            // Si aucune flotte n'est associée à ce user, on peut la créer
            $fleet = new Fleet($createFleet->fleetId, $createFleet->userId);
            $this->fleetRepository->save($fleet);

            return;
        }

        throw new FleetAlreadyCreated($existingFleet->getId()->toString(), $createFleet->userId);
    }
}
