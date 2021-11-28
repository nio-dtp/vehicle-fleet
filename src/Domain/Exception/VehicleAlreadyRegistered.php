<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Exception;

final class VehicleAlreadyRegistered extends \DomainException
{
    public function __construct(string $fleetId, string $vehicleId)
    {
        parent::__construct(sprintf('Le véhicule (id:%s) est déjà enregistré dans la flotte (id:%s)', $vehicleId, $fleetId));
    }
}
