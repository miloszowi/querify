<?php

declare(strict_types=1);

namespace Querify\Infrastructure\ExternalServices\Slack\Http\Response;

use Querify\Infrastructure\ExternalServices\Slack\Http\Response\UserInfo\User;

final readonly class UserInfoResponse
{
    public function __construct(
        public bool $ok,
        public ?string $error,
        public ?User $user
    ) {}
}
