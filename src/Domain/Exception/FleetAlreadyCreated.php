<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Exception;

use Throwable;

final class FleetAlreadyCreated extends \RuntimeException
{
    public function __construct(string $fleetId, int $userId)
    {
        parent::__construct(sprintf('L‘utilisateur (id:%s) a déjà une flotte créée (id:%s)', $userId, $fleetId));
    }
}
