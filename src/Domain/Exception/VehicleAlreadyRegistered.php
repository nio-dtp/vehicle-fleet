<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Exception;

final class VehicleAlreadyRegistered extends \DomainException
{
    public function __construct(int $fleetId, int $vehicleId)
    {
        parent::__construct(sprintf('Le véhicule (id:%d) est déjà enregistré dans la flotte (id:%d)', $vehicleId, $fleetId));
    }
}
