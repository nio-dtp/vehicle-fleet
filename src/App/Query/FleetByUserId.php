<?php

declare(strict_types=1);

namespace VehicleFleet\App\Query;

final class FleetByUserId
{
    public function __construct(public int $userId)
    {
    }
}
