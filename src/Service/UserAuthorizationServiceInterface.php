<?php
declare(strict_types=1);

namespace Iam\Service;

use Iam\Builder\PolicyBuilderInterface;
use Iam\Builder\PolicyStringBuilderInterface;
use Iam\Model\Entity\User;

interface UserAuthorizationServiceInterface
{
    public function hasPolicyTo(User $user, PolicyStringBuilderInterface $policy) : bool;
}