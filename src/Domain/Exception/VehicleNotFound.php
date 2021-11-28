<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Exception;

final class VehicleNotFound extends \DomainException
{
    public function __construct(string $fleetId, string $vehicleId)
    {
        parent::__construct(sprintf('Le véhicule (id:%s) n‘est pas présent dans la flotte (id:%s)', $vehicleId, $fleetId));
    }
}
