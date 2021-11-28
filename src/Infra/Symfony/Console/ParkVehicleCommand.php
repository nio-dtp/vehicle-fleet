<?php

declare(strict_types=1);

namespace VehicleFleet\Infra\Symfony\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use VehicleFleet\App\Command\ParkVehicle;
use VehicleFleet\App\Command\ParkVehicleHandler;
use VehicleFleet\Domain\Exception\FleetNotFound;
use VehicleFleet\Domain\Exception\VehicleAlreadyParked;
use VehicleFleet\Domain\Exception\VehicleNotFound;

final class ParkVehicleCommand extends Command
{
    public function __construct(private ParkVehicleHandler $parkVehicleHandler)
    {
        parent::__construct('vehicle-fleet:vehicle:park');
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Register a vehicle.')
            ->addArgument(name: 'fleetId', mode: InputOption::VALUE_REQUIRED, description: 'Fleet id')
            ->addArgument(name: 'vehiclePlateNumber', mode: InputOption::VALUE_REQUIRED, description: 'Vehicle plate number')
            ->addArgument(name: 'latitude', mode: InputOption::VALUE_REQUIRED, description: 'latitude')
            ->addArgument(name: 'longitude', mode: InputOption::VALUE_REQUIRED, description: 'longitude')
            ->addArgument(name: 'altitude', mode: InputOption::VALUE_OPTIONAL, description: 'altitude')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $vehiclePlateNumber = $input->getArgument('vehiclePlateNumber');
            $altitude = $input->getArgument('altitude');
            $this->parkVehicleHandler->handle(
                new ParkVehicle(
                    $input->getArgument('fleetId'),
                    $vehiclePlateNumber,
                    (float) $input->getArgument('latitude'),
                    (float) $input->getArgument('longitude'),
                    0 < count($altitude) ? (int) $altitude[0] : null
                )
            );
        } catch (FleetNotFound | VehicleNotFound | VehicleAlreadyParked $exception) {
            $output->writeln($exception->getMessage());

            return self::FAILURE;
        }
        $output->writeln(sprintf('Véhicule garé (id:%s)', $vehiclePlateNumber));

        return self::SUCCESS;
    }
}
