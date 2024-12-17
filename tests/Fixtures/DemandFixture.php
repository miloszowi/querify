<?php

declare(strict_types=1);

namespace Querify\Tests\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Querify\Domain\Demand\Demand;
use Querify\Domain\User\User;

class DemandFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = $this->getReference(UserFixture::USER_EMAIL_FIXTURE, User::class);
        $demand = new Demand(
            $user,
            'querify_postgres',
            'test content',
            'test reason'
        );

        $approvedDemand = new Demand(
            $user,
            'querify_postgres',
            'test approved content',
            'test approved reason'
        );
        $approvedDemand->approveBy($user);

        $declinedDemand = new Demand(
            $user,
            'querify_postgres',
            'test declined content',
            'test declined reason'
        );
        $declinedDemand->declineBy($user);

        $manager->persist($demand);
        $manager->persist($approvedDemand);
        $manager->persist($declinedDemand);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
        ];
    }
}