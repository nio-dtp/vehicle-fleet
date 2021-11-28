<?php

declare(strict_types=1);

namespace VehicleFleet\App\Command;

use Ramsey\Uuid\UuidInterface;

final class CreateFleet
{
    public function __construct(public UuidInterface $fleetId, public int $userId)
    {
    }
}
