<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Model;

final class Vehicle
{
    public function __construct(
        private int $id
    ) {
    }
}
