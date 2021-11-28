<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
final class Vehicle
{
    /** @ORM\Column(type="float", nullable=true) */
    private ?float $latitude;
    /** @ORM\Column(type="float", nullable=true) */
    private ?float $longitude;
    /** @ORM\Column(type="integer", nullable=true) */
    private ?int $altitude;

    public function __construct(
        /** @ORM\Id @ORM\Column(type="string", length="15") */
        private string $id
    ) {
    }

    public function park(float $latitude, float $longitude, ?int $altitude): void
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->altitude = $altitude;
    }

    public function isEqualTo(Vehicle $vehicle): bool
    {
        return $vehicle->getId() === $this->id;
    }

    public function isParkedAtThisLocation(float $latitude, float $longitude, ?int $altitude): bool
    {
        return $latitude === $this->latitude && $longitude === $this->longitude && $altitude === $this->altitude;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
