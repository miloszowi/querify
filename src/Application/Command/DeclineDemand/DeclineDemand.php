<?php

declare(strict_types=1);

namespace Querify\Application\Command\DeclineDemand;

use Querify\Domain\User\User;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage]
readonly class DeclineDemand
{
    public function __construct(
        public UuidInterface $demandUuid,
        public User $approver,
    ) {}
}