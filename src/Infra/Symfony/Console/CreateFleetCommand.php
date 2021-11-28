<?php

declare(strict_types=1);

namespace VehicleFleet\Infra\Symfony\Console;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use VehicleFleet\App\Command\CreateFleet;
use VehicleFleet\App\Command\CreateFleetHandler;
use VehicleFleet\Domain\Exception\FleetAlreadyCreated;

final class CreateFleetCommand extends Command
{
    public function __construct(private CreateFleetHandler $registerVehicleHandler)
    {
        parent::__construct('vehicle-fleet:fleet:create');
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Create a new fleet.')
            ->addArgument(name: 'userId', mode: InputOption::VALUE_REQUIRED, description: 'User id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fleetId = Uuid::uuid4();
        try {
            $this->registerVehicleHandler->handle(
                new CreateFleet($fleetId, (int) $input->getArgument('userId'))
            );
        } catch (FleetAlreadyCreated $exception) {
            $output->writeln($exception->getMessage());

            return self::FAILURE;
        }
        $output->writeln(sprintf('Flotte créée (id:%s)', $fleetId->toString()));

        return self::SUCCESS;
    }
}
