<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Model;

final class Vehicle
{
    public function __construct(
        private int $id
    ) {
    }

    public function isEqualTo(Vehicle $vehicle): bool
    {
        return  $vehicle->getId() === $this->id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
