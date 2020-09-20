<?php
declare(strict_types=1);

namespace Iam\Service;

use Iam\Builder\PolicyBuilderInterface;
use Iam\Model\Entity\User;

interface UserAuthorizationServiceInterface
{
    public function hasPolicyTo(User $user, PolicyBuilderInterface $policy) : bool;
}