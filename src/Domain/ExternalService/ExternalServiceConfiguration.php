<?php

declare(strict_types=1);

namespace Querify\Domain\ExternalService;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

#[
    ORM\Entity,
    ORM\Table('`external_service_configuration`')
]
class ExternalServiceConfiguration
{
    public function __construct(
        #[
            ORM\Id,
            ORM\Column(type: 'string', nullable: false),
        ]
        public readonly string $externalServiceName,
        /**
         * @var UuidInterface[]
         */
        #[ORM\Column(type: 'uuid_array')]
        public array $eligibleApprovers,
    ) {}
}
