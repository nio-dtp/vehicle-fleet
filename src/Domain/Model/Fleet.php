<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use VehicleFleet\Domain\Exception\VehicleAlreadyParked;
use VehicleFleet\Domain\Exception\VehicleAlreadyRegistered;
use VehicleFleet\Domain\Exception\VehicleNotFound;

/** @ORM\Entity */
final class Fleet
{
    /** @ORM\ManyToMany(targetEntity="Vehicle", cascade={"persist"}) */
    private Collection $vehicles;

    public function __construct(
        /** @ORM\Id @ORM\Column(type="uuid") */
        private UuidInterface $id,
        /** @ORM\Column(type="integer", unique=true) */
        private int $userId,
        array $vehicles = []
    ) {
        $this->vehicles = new ArrayCollection($vehicles);
    }

    /**
     * @throws VehicleAlreadyRegistered
     */
    public function registerVehicle(string $vehicleId): void
    {
        if ($this->hasVehicle($vehicleId)) {
            throw new VehicleAlreadyRegistered($this->id->toString(), $vehicleId);
        }
        $this->vehicles->add(new Vehicle($vehicleId));
    }

    /**
     * @throws VehicleNotFound
     * @throws VehicleAlreadyParked
     */
    public function parkVehicle(string $vehicleId, float $latitude, float $longitude, ?int $altitude): void
    {
        $vehicle = $this->getVehicle($vehicleId);
        if (null === $vehicle) {
            throw new VehicleNotFound($this->id->toString(), $vehicleId);
        }
        if ($vehicle->isParkedAtThisLocation($latitude, $longitude, $altitude)) {
            throw new VehicleAlreadyParked($vehicleId, $latitude, $longitude, $altitude);
        }
        $vehicle->park($latitude, $longitude, $altitude);
    }

    private function hasVehicle(string $vehicleId): bool
    {
        return null !== $this->getVehicle($vehicleId);
    }

    private function getVehicle(string $vehicleId): ?Vehicle
    {
        $vehicle = new Vehicle($vehicleId);
        foreach ($this->vehicles as $fleetVehicle) {
            if ($fleetVehicle->isEqualTo($vehicle)) {
                return $fleetVehicle;
            }
        }

        return null;
    }
}
