<?php

declare(strict_types=1);

namespace VehicleFleet\Infra\Symfony\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use VehicleFleet\App\Command\RegisterVehicle;
use VehicleFleet\App\Command\RegisterVehicleHandler;
use VehicleFleet\Domain\Exception\FleetNotFound;
use VehicleFleet\Domain\Exception\VehicleAlreadyRegistered;

final class RegisterVehicleCommand extends Command
{
    public function __construct(private RegisterVehicleHandler $registerVehicleHandler)
    {
        parent::__construct('vehicle-fleet:vehicle:register');
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Register a vehicle.')
            ->addArgument(name: 'fleetId', mode: InputOption::VALUE_REQUIRED, description: 'Fleet id')
            ->addArgument(name: 'vehiclePlateNumber', mode: InputOption::VALUE_REQUIRED, description: 'Vehicle plate number')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $vehiclePlateNumber = $input->getArgument('vehiclePlateNumber');
            $this->registerVehicleHandler->handle(
                new RegisterVehicle($input->getArgument('fleetId'), $vehiclePlateNumber)
            );
        } catch (FleetNotFound | VehicleAlreadyRegistered $exception) {
            $output->writeln($exception->getMessage());

            return self::FAILURE;
        }
        $output->writeln(sprintf('Véhicule enregistré (id:%s)', $vehiclePlateNumber));

        return self::SUCCESS;
    }
}
