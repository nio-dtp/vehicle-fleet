<?php

declare(strict_types=1);

namespace VehicleFleet\Domain\Exception;

final class VehicleAlreadyParked extends \DomainException
{
    public function __construct(string $vehicleId, float $latitude, float $longitude, ?int $altitude)
    {
        parent::__construct(sprintf(
            'Le véhicule (id:%s) est déjà stationné à cette place (lat:%f, lon:%f, alt:%d)',
            $vehicleId,
            $latitude,
            $longitude,
            $altitude
        ));
    }
}
