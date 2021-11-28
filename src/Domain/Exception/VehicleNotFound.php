<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Exception;

final class VehicleNotFound extends \DomainException
{
    public function __construct(int $fleetId, int $vehicleId)
    {
        parent::__construct(sprintf('Le véhicule (id:%d) n‘est pas présent dans la flotte (id:%d)', $vehicleId, $fleetId));
    }
}
