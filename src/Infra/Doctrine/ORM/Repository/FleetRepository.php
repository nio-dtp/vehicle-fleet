<?php

declare(strict_types=1);

namespace VehicleFleet\Infra\Doctrine\ORM\Repository;

use Doctrine\ORM\EntityManagerInterface;
use VehicleFleet\Domain\Exception\FleetNotFound;
use VehicleFleet\Domain\Model\Fleet;
use VehicleFleet\Domain\Repository\FleetRepositoryInterface;

final class FleetRepository implements FleetRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getByUserId(int $userId): Fleet
    {
        $dqlQuery = $this->entityManager->createQuery('SELECT fleet FROM VehicleFleet:Fleet fleet WHERE fleet.userId = :userId');
        $dqlQuery->setParameter('userId', $userId);
        /** @var Fleet|null $fleet */
        $fleet = $dqlQuery->getOneOrNullResult();
        if (null === $fleet) {
            throw new FleetNotFound();
        }

        return $fleet;
    }

    public function getById(string $id): Fleet
    {
        // TODO: Implement getById() method.
    }

    public function save(Fleet $fleet): void
    {
        $this->entityManager->persist($fleet);
        $this->entityManager->flush();
    }
}
