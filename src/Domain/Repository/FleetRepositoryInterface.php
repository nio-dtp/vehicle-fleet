<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Repository;

use VehicleFleet\Domain\Exception\FleetNotFound;
use VehicleFleet\Domain\Model\Fleet;

interface FleetRepositoryInterface
{
    /**
     * @throws FleetNotFound
     */
    public function getByUserId(int $userId): Fleet;

    /**
     * @throws FleetNotFound
     */
    public function getById(string $id): Fleet;

    public function save(Fleet $fleet): void;
}
