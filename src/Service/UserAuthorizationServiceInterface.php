<?php
declare(strict_types=1);

namespace Iam\Service;

use Iam\Model\Entity\User;

interface UserAuthorizationServiceInterface
{
    public function hasPolicyTo(User $user, string $policy) : bool;
}